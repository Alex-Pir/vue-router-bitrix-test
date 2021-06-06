<?
  require_once("functions.php");

  // Проверяем, есть ли файл вебхуков, и создаем, если нет
  $year = date("Y");

  $webhooksFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/calltouch_".$year.".json";                                                         // Вебхуки
  if(!file_exists($webhooksFile)) copy($_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/templates/webhooks.json", $webhooksFile);
  $webhooks = json_decode(file_get_contents($webhooksFile), true);

  $phonesFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_phones.json";                                                                      // Телефоны
  $phones = json_decode(file_get_contents($phonesFile), true);

  $gcidsFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_gcids.json";                                                                        // GCIDы
  $gcids = json_decode(file_get_contents($gcidsFile), true);

  // Собираем параметры
  $webhook = array(
    "id"             => (isset($_POST["id"]) && $_POST["id"] != '') ? $_POST["id"] : "Отсутствует",                                               // id звонка в Calltouch
    "ctCallerId"     => (isset($_POST["ctCallerId"]) && $_POST["ctCallerId"] != '') ? $_POST["ctCallerId"] : "Отсутствует",                       // id клиента в Calltouch
    "callerphone"    => (isset($_POST["callerphone"]) && $_POST["callerphone"] != '') ? $_POST["callerphone"] : "Отсутствует",                    // номер телефона клиента
    "duration"       => (isset($_POST["duration"]) && $_POST["duration"] != '') ? $_POST["duration"] : "Отсутствует",                             // длительность разговора
    "calltime"       => (isset($_POST["timestamp"]) && $_POST["timestamp"] != '') ? (int)$_POST["timestamp"] : "Отсутствует",                          // время звонка начала звонка Unix
    "status"         => (isset($_POST["status"]) && $_POST["status"] != '') ? $_POST["status"] : "Отсутствует",                                   // статус звонка
    "unique"         => (isset($_POST["unique"]) && $_POST["unique"] != '') ? $_POST["unique"] : "Отсутствует",                                   // уникальность звонка
    "targetcall"     => (isset($_POST["targetcall"]) && $_POST["targetcall"] != '') ? $_POST["targetcall"] : "Отсутствует",                       // целевой ли звонок
    "uniqtargetcall" => (isset($_POST["uniqtargetcall"]) && $_POST["uniqtargetcall"] != '') ? $_POST["uniqtargetcall"] : "Отсутствует",           // уникально целевой звонок
    "source"         => (isset($_POST["source"]) && $_POST["source"] != '') ? $_POST["source"] : "Отсутствует",                                   // источник
    "medium"         => (isset($_POST["medium"]) && $_POST["medium"] != '') ? $_POST["medium"] : "Отсутствует",                                   // медиум
    "utm_source"     => (isset($_POST["utm_source"]) && $_POST["utm_source"] != '') ? $_POST["utm_source"] : "Отсутствует",                       // utm_source
    "utm_medium"     => (isset($_POST["utm_medium"]) && $_POST["utm_medium"] != '') ? $_POST["utm_medium"] : "Отсутствует",                       // utm_medium
    "utm_campaign"   => (isset($_POST["utm_campaign"]) && $_POST["utm_campaign"] != '') ? $_POST["utm_campaign"] : "Отсутствует",                 // utm_campaign
    "utm_content"    => (isset($_POST["utm_content"]) && $_POST["utm_content"] != '') ? $_POST["utm_content"] : "Отсутствует",                    // utm_content
    "utm_term"       => (isset($_POST["utm_term"]) && $_POST["utm_term"] != '') ? $_POST["utm_term"] : "Отсутствует",                             // utm_term
    "gcid"           => (isset($_POST["gcid"]) && $_POST["gcid"] != '') ? $_POST["gcid"] : "Отсутствует",                                         // google client id
    "yaClientId"     => (isset($_POST["yaClientId"]) && $_POST["yaClientId"] != '') ? $_POST["yaClientId"] : "Отсутствует",                       // yandex client id
    "url"            => (isset($_POST["url"]) && $_POST["url"] != '') ? $_POST["url"] : "Отсутствует",                                            // страница входа
    "callUrl"        => (isset($_POST["callUrl"]) && $_POST["callUrl"] != '') ? $_POST["callUrl"] : "Отсутствует",                                // страница звонка
    "ref"            => (isset($_POST["ref"]) && $_POST["ref"] != '') ? $_POST["ref"] : "Отсутствует",                                            // реферер
    "city"           => (isset($_POST["city"]) && $_POST["city"] != '') ? $_POST["city"] : "Отсутствует",                                         // город
    "ip"             => (isset($_POST["ip"]) && $_POST["ip"] != '') ? $_POST["ip"] : "Отсутствует"                                                // ip
  );

  // Для удобства самые для нас важные парамметры вынесем в отдельные переменные
  $c_lcav = ($webhook["utm_medium"] == "cpc" && strpos($webhook["utm_campaign"], 'brend') === false) ? "lcav" : "non-lcav";                       // Прямой, непрямой или брендовый заход
  $c_phone = $webhook["callerphone"];
  $c_timestamp = $webhook["calltime"];
  $c_gcid = $webhook["gcid"];
  $c_ip = $webhook["ip"];

  // Записываем в вебхуки
  $webhooks["webhooks"][] = $webhook;
  
  // Отправляем данные по Measurement Protocol (важно делать это до создания записей в бызах $phones и $gcids)
  if($c_gcid != "Отсутствует" && $c_phone != "Отсутствует") {
    $lastTimestamp = "1";                                                                                                                         // Для начала находим последний звонок
    if($gcids["gcids"][$c_gcid][$c_phone]) {
      foreach($gcids["gcids"][$c_gcid][$c_phone] as $case) {
        foreach($case as $l_timestamp=>$l_status) {
          if((int)$l_timestamp > (int)$lastTimestamp) $lastTimestamp = $l_timestamp;
        }
      }
    }

    if($lastTimestamp == "1" || $c_timestamp - (int)$lastTimestamp > 604800) {                                                                    // Если есть старые звонки, и последний был больше 7 дней назад
      $event = "DSPUniqueLead";                                                                                                                   // То событие будет уникальным
    } else {                                                                                                                                      // Иначе
      $event = "DSPNotUniqueLead";                                                                                                                // Неуникальным
    }
    $x  = array(
      "v"   => "1",
      "tid" => "UA-66558052-1",
      "cid" => $c_gcid,
      "t"   => "event",
      "ec"  => "measurementProtocolCalltouch",
      "ea"  => $event,
      "el"  => $c_phone,
      "cd1" => $c_ip,
      "cd2" => $c_gcid,
      "cd3" => date('Y-m-d H:i:s', $c_timestamp),
      "cd4" => $c_phone,
      "cd6" => $c_timestamp,
    );
    sendToGA($x);
  }

  // Если есть телефон и gcid
  if($c_phone != "Отсутствует") {
    // Добавляем запись в базу телефонов
    if($c_gcid != 'Отсутствует') {
      if(!$phones["phones"][$c_phone]["orders"][$c_gcid]) $phones["phones"][$c_phone]["orders"][$c_gcid] = array();
      if($c_lcav == "lcav") $phones["phones"][$c_phone]["lcav"] = array(
        "calltouch", $c_timestamp, $c_gcid
      );
    } else {
      if(!$phones["phones"][$c_phone]) $phones["phones"][$c_phone] = array();
    }
  
    // Добавляем запись в базу gcid
    if($c_gcid != 'Отсутствует') {
      $gcids["gcids"][$c_gcid][$c_phone]["calltouch"][$c_timestamp] = $c_lcav;
    }
  } 

  file_put_contents($webhooksFile, json_encode($webhooks, JSON_UNESCAPED_UNICODE));
  file_put_contents($phonesFile, json_encode($phones, JSON_UNESCAPED_UNICODE));
  file_put_contents($gcidsFile, json_encode($gcids, JSON_UNESCAPED_UNICODE));
?>