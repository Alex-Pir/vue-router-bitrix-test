<?
  require_once("functions.php");

  // Проверяем, есть ли файл вебхуков, и создаем, если нет
  $year = date("Y");

  $webhooksFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/envybox_".$year.".json";                                                         // Вебхуки
  if(!file_exists($webhooksFile)) copy($_SERVER['DOCUMENT_ROOT']."/dspanalytics/templates/webhooks.json", $webhooksFile);
  $webhooks = json_decode(file_get_contents($webhooksFile), true);

  $phonesFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_phones.json";                                                                      // Телефоны
  $phones = json_decode(file_get_contents($phonesFile), true);

  $gcidsFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_gcids.json";                                                                        // GCIDы
  $gcids = json_decode(file_get_contents($gcidsFile), true);

  $webhookType = $_POST["webhooktype"];
  // Собираем параметры
  $webhook = array(
    "phone"             => (isset($_POST["phone"]) && $_POST["phone"] != '') ? $_POST["phone"] : "Отсутствует",                                   // телефон
    "name"              => (isset($_POST["name"]) && $_POST["name"] != '') ? $_POST["name"] : "Отсутствует",                                      // имя
    "email"             => (isset($_POST["email"]) && $_POST["email"] != '') ? $_POST["email"] : "Отсутствует",                                   // email
    "created_at"        => (isset($_POST["created_at"]) && $_POST["created_at"] != '') ? strtotime($_POST["created_at"]) : "Отсутствует",         // время создания заявки
    "called_at"         => (isset($_POST["called_at"]) && $_POST["called_at"] != '') ? strtotime($_POST["called_at"]) : "Отсутствует",            // время звонка
    "call_state"        => (isset($_POST["call_state"]) && $_POST["call_state"] != '') ? $_POST["call_state"] : "Отсутствует",                    // статус звонка
    "call_duration"     => (isset($_POST["call_duration"]) && $_POST["call_duration"] != '') ? $_POST["call_duration"] : "Отсутствует",           // длительность звонка
    "referrer"          => (isset($_POST["referrer"]) && $_POST["referrer"] != '') ? $_POST["referrer"] : "Отсутствует",                          // источник
    "url"               => (isset($_POST["url"]) && $_POST["url"] != '') ? $_POST["url"] : "Отсутствует",                                         // страница сайта
    "keyword"           => (isset($_POST["keyword"]) && $_POST["keyword"] != '') ? $_POST["keyword"] : "Отсутствует",                             // ключевое слово
    "ip"                => (isset($_POST["ip"]) && $_POST["ip"] != '') ? $_POST["ip"] : "Отсутствует",                                            // ip
    "place"             => (isset($_POST["place"]) && $_POST["place"] != '') ? $_POST["place"] : "Отсутствует",                                   // местоположение посетителя
    "shown_on"          => (isset($_POST["shown_on"]) && $_POST["shown_on"] != '') ? $_POST["shown_on"] : "Отсутствует",                          // как было показано окно обратного звонка
    "utm_source"        => (isset($_POST["utm_source"]) && $_POST["utm_source"] != '') ? $_POST["utm_source"] : "Отсутствует",                    // utm_source
    "utm_medium"        => (isset($_POST["utm_medium"]) && $_POST["utm_medium"] != '') ? $_POST["utm_medium"] : "Отсутствует",                    // utm_medium
    "utm_campaign"      => (isset($_POST["utm_campaign"]) && $_POST["utm_campaign"] != '') ? $_POST["utm_campaign"] : "Отсутствует",              // utm_campaign
    "utm_content"       => (isset($_POST["utm_content"]) && $_POST["utm_content"] != '') ? $_POST["utm_content"] : "Отсутствует",                 // utm_content
    "utm_term"          => (isset($_POST["utm_term"]) && $_POST["utm_term"] != '') ? $_POST["utm_term"] : "Отсутствует",                          // utm_term
    "visitor_id"        => (isset($_POST["visitor_id"]) && $_POST["visitor_id"] != '') ? $_POST["visitor_id"] : "Отсутствует",                    // уникальный id посетителя
    "google_client_id"  => (isset($_POST["google_client_id"]) && $_POST["google_client_id"] != '') ? $_POST["google_client_id"] : "Отсутствует",  // google client id
  );

  // Для удобства самые для нас важные парамметры вынесем в отдельные переменные
  $c_lcav = ($webhook["utm_medium"] == "cpc" && strpos($webhook["utm_campaign"], 'brend') === false) ? "lcav" : "non-lcav";                       // Прямой, непрямой или брендовый заход
  $c_phone = $webhook["phone"];
  $c_timestamp = $webhook["created_at"];
  $c_gcid = $webhook["google_client_id"];
  $c_ip = $webhook["ip"];

  // Записываем в вебхуки
  if($webhookType == "1") {                                                                                                                       // если это заказ звонка, то просто создаем вебхук
    $webhooks["webhooks"][] = $webhook;
  } else if($webhookType == "2") {                                                                                                                // если это результат звонка, то ищем старый и перезаписываем его
    $hasWebhook = false;
    foreach($webhooks["webhooks"] as $k=>$w) {
      if($w["created_at"] == $c_timestamp) {
        $hasWebhook = $k;
        break;
      }
    }
    if($hasWebhook) {
      $webhooks["webhooks"][$k] = $webhook;
    } else {
      $webhooks["webhooks"][] = $webhook;
    }
  }
  
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
      "ec"  => "measurementProtocolEnvybox",
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

  // Если есть телефон
  if($c_phone != "Отсутствует") {
    // Добавляем запись в базу телефонов
    if($c_gcid != 'Отсутствует') {
      if(!$phones["phones"][$c_phone]["orders"][$c_gcid]) $phones["phones"][$c_phone]["orders"][$c_gcid] = array();
      if($c_lcav == "lcav") $phones["phones"][$c_phone]["lcav"] = array(
        "envybox", $c_timestamp, $c_gcid
      );
    } else {
      if(!$phones["phones"][$c_phone]) $phones["phones"][$c_phone] = array();
    }
  
    // Добавляем запись в базу gcid
    if($c_gcid != 'Отсутствует') {
      $gcids["gcids"][$c_gcid][$c_phone]["envybox"][$c_timestamp] = $c_lcav;
    }
  } 

  file_put_contents($webhooksFile, json_encode($webhooks, JSON_UNESCAPED_UNICODE));
  file_put_contents($phonesFile, json_encode($phones, JSON_UNESCAPED_UNICODE));
  file_put_contents($gcidsFile, json_encode($gcids, JSON_UNESCAPED_UNICODE));
?>