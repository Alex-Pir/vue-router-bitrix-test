<?php
  function saveSiteCall($name, $phone, $ip, $gcid, $time) {
    // Проверяем файл
    $year = date("Y");
    $file = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/site_".$year.".json";
    if(!file_exists($file)) copy($_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/templates/webhooks.json", $file);

    // Собираем поля
    $name = $name != "" ? $name : "Отсутствует";
    $phone = $phone != "" ? substr_replace(preg_replace('/[^0-9]/', '', $phone), "7", 0, 1) : "Отсутствует";
    $ip = $ip != "" ? $ip : $_SERVER['REMOTE_ADDR'];
    $gcid = $gcid != "" ? $gcid : "Отсутствует";
    //$time = $time != "" ? $time : date("Y.m.d H:i:s");
    $time = time();

    // Записываем в файл
    $webhooks = json_decode(file_get_contents($file), true);

    $webhooks['webhooks'][] = array(
      "name"  => $name,
      "phone" => $phone,
      "ip"    => $ip,
      "gcid"  => $gcid,
      "time"  => $time
    );

    file_put_contents($file, json_encode($webhooks, JSON_UNESCAPED_UNICODE));
  }
?>