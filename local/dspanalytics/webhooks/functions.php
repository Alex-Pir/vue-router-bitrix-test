<?
  // функция получения заказа
  function getOrderFields($url) {
    $url = stripslashes($url);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,array(
      'Content-type: application/json',
      'Authorization: Basic c2VvQDFkc3A6MWRzcCFRQVp6YXEx'
    ));

    $moysklad_output = curl_exec($curl);
    curl_close($curl);

    // Превращаем ответ в массив
    $moysklad_output = json_decode($moysklad_output, true);

    return $moysklad_output;
  }

  // функция проверки телефонов
  function checkPhones($temp_phones, $new_agent) {
    $temp_phones = explode(",", $temp_phones);
    foreach($temp_phones as $temp_phone) {
      $temp_phone = preg_replace('/[^0-9]/', '', $temp_phone);
      if($temp_phone[0] == "8") substr_replace($temp_phone, "7", 0, 1);
      if(strlen($temp_phone) == 11 && !in_array($temp_phone, $new_agent["phones"])) $new_agent["phones"][] = $temp_phone;
    }

    return $new_agent;
  }

  // функция получения телефона пользователя (для шаблона, чтоб передать его в глобальную js-переменную)
  function getUserPhone() {
    $gcid = "Отсутствует";
    if (isset($_COOKIE['_ga'])) {
      list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
      $contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1.'.'.$cid2);
      $gcid = $contents['cid'];
    }

    $user = array(
      "phone" => "",
      "agent" => "",
      "ts"    => "",
      "ts_u"  => ""
    );

    if(!$_SESSION["user_time"]) $_SESSION["user_time"] = time();
    $user["ts"] = date('Y-m-d H:i:s', $_SESSION["user_time"]);
    $user["ts_u"] = $_SESSION["user_time"];

    $gcidsFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_gcids.json";
    $gcids = json_decode(file_get_contents($gcidsFile), true);
    $phonesFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_phones.json";
    $phones = json_decode(file_get_contents($phonesFile), true);
    $agentsFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/base_agents.json";
    $agents = json_decode(file_get_contents($agentsFile), true);

    if($gcid != "Отсутствует" && $gcids["gcids"][$gcid]) {
      $n_timestamp = 1;
      foreach($gcids["gcids"][$gcid] as $phone=>$webhooks) {
        foreach($webhooks as $webhook) {
          foreach($webhook as $timestamp=>$status) {
            if($timestamp > $n_timestamp) {
              $n_timestamp = $timestamp;
              $user["phone"] = $phone;
            }
          }
        }
      }
    }

    if($user["phone"] == '' || $gcid == "Отсутствует") {
      $user["phone"] = 'Отсутствует';
      $user["agent"] = 'Отсутствует';
    } else {
      $user["agent"] = $agents["agents"][$phones["phones"][$user["phone"]]["agent"]]["name"];
    }
    unset($gcid);
    return $user;
  }

  // отправка события на GA
  function sendToGA($data) {
    $data = http_build_query($data);
    $curl = curl_init();
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_URL,"https://www.google-analytics.com/collect");
    curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-type: application/x-www-form-urlencoded'));
    curl_setopt($curl, CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec ($curl);

    curl_close ($curl);
  }
?>