<?
  require_once("functions.php");

  // сам вебхук
  $webhook = json_decode(file_get_contents('php://input'), true);

  // БАЗА Контрагенты
  $agentsFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_agents.json";
  $agents = json_decode(file_get_contents($agentsFile), true);
  // БАЗА Телефоны
  $phonesFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_phones.json";
  $phones = json_decode(file_get_contents($phonesFile), true);

  // вообще, у нас может быть только одно событие, но события передаются в виде массива, а не объекта, посему перебор
  foreach($webhook["events"] as $event) {
    // получаем самого контрагента
    $agent = getOrderFields($event["meta"]["href"]);
          
    // собираем контрагента
    $new_agent = array(
      "name"       => $agent["name"],
      "legalTitle" => $agent["legalTitle"],
      "updated"    => strtotime($agent["updated"]),
      "phones"     => array()
    );
    
    // собираем телефоны агента (Красоту и оптимизацию потом делать буду)
    if($agent["phone"]) $new_agent = checkPhones($agent["phone"], $new_agent);  // сначала из телефонов конрагента
    if($agent["fax"]) $new_agent = checkPhones($agent["fax"], $new_agent);      // теперь из факсов
    if($agent["contactpersons"]["meta"]["size"] != 0) {                         // и если у пользователя есть контактные лица, то и из каждого контактного лица
      $contactpersons = getOrderFields($agent["contactpersons"]["meta"]["href"]);
      foreach($contactpersons["rows"] as $row) {
        if($row["phone"]) $new_agent = checkPhones($row["phone"], $new_agent);
      }
    }

    // Для каждого телефона в базе телефонов проставляем этого контрагента, тк он изменялся последним
    foreach($new_agent["phones"] as $phone) {
      if($phones["phones"][$phone]) $phones["phones"][$phone]["agent"] = $agent["id"];
    }
    
    // записываем контрагента в базу контрагентов (если есть, то перезаписываем)
    $agents["agents"][$agent["id"]] = $new_agent;
  }

  file_put_contents($phonesFile, json_encode($phones, JSON_UNESCAPED_UNICODE));
  file_put_contents($agentsFile, json_encode($agents, JSON_UNESCAPED_UNICODE));
?>