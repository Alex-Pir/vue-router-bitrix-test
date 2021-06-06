<?
  require_once("functions.php");

  // сам вебхук
  $webhook = json_decode(file_get_contents('php://input'), true);

  // вообще, у нас может быть только одно событие, но события передаются в виде массива, а не объекта, посему перебор
  foreach($webhook["events"] as $event) {
    // получаем сам заказ
    $order = getOrderFields($event["meta"]["href"]);
    
    // Дальнейшая работа очень сложная, и делать ее для всех вебхуков бессмысленно. Делаем только по проходении проверки.
    // если у заказа статус "Доставлен, Отгружен" (только проверка по ссылке, чтоб запросы не плодить)
    if(end(explode("/", $order["state"]["meta"]["href"])) == "8da65cb3-8406-11e3-e7ed-002590a28eca") {
      // БАЗА Заказы
      $ordersFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_orders.json";
      $orders = json_decode(file_get_contents($ordersFile), true);
      // БАЗА Контрагенты
      $agentsFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_agents.json";
      $agents = json_decode(file_get_contents($agentsFile), true);
      // БАЗА Телефоны
      $phonesFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_phones.json";
      $phones = json_decode(file_get_contents($phonesFile), true);
  
      // получаем контрагента
      $agent = end(explode("/", $order["agent"]["meta"]["href"]));

      // собираем заказ
      $new_order = array (
        "state" => end(explode("/", $order["state"]["meta"]["href"])),
        "sum"   => $order["sum"]/100,
        "agent" => $agent
      );
      // записываем заказ в базу заказов (если есть, то перезаписываем)
      $orders["orders"][$order["name"]] = $new_order;

      // если у контрагента есть корректные телефоны
      if(!empty($agents["agents"][$agent]["phones"])) {
        $a_phone = "";
        $a_gcid = "";
        $a_timestamp = 1;
        // то для каждого телефона делаем проверку по последнему непрямому небрендовому заходу
        foreach($agents["agents"][$agent]["phones"] as $phone) {
          if($phones["phones"][$phone]["lcav"] && $phones["phones"][$phone]["lcav"][1] > $a_timestamp) {
            $a_phone = $phone;
            $a_gcid = $phones["phones"][$phone]["lcav"][2];
            $a_timestamp = $phones["phones"][$phone]["lcav"][1];
          }
        }

        // если подходящий телефон нашелся и такого заказа еще нет в базе
        if($a_phone != "") {
          // записываем заказ для данного телефона
          $phones["phones"][$a_phone]["orders"][$a_gcid][] = $order["name"];

          // отправляем ecommerce в analytics
          $x = array(
            "v"   => "1",
            "tid" => "UA-66558052-1",
            "cid" => $a_gcid,
            "t"   => "transaction",
            "ti"  => $order["name"],
            "tr"  => $order["sum"]/100,
            "cd2" => $a_gcid,
            "cd3" => date('Y-m-d H:i:s', $a_timestamp),
            "cd4" => $a_phone,
            "cd5" => $agents["agents"][$agent]["name"],
            "cd6" => $a_timestamp,
          );
          sendToGA($x);
          // отправляем события в analytics
          $y = array(
            "v"   => "1",
            "tid" => "UA-66558052-1",
            "cid" => $a_gcid,
            "t"   => "event",
            "ec"  => "measurementProtocolEcommerce",
            "ea"  => "order",
            "el"  => $order["name"],
            "ev"  => $order["sum"]/100,
            "cd2" => $a_gcid,
            "cd3" => date('Y-m-d H:i:s', $a_timestamp),
            "cd4" => $a_phone,
            "cd5" => $agents["agents"][$agent]["name"],
            "cd6" => $a_timestamp,
          );
          sendToGA($y);
        }
      }

      file_put_contents($ordersFile, json_encode($orders, JSON_UNESCAPED_UNICODE));
      file_put_contents($phonesFile, json_encode($phones, JSON_UNESCAPED_UNICODE));
    }
  }
?>