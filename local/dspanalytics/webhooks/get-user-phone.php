<?php
  function getUserPhone() {

    $gcid = "Отсутствует";
    if (isset($_COOKIE['_ga'])) {
      list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
      $contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1.'.'.$cid2);
      $gcid = $contents['cid'];
    }

    $userPhone = '';

    $gcidsFile = $_SERVER['DOCUMENT_ROOT']."/dspanalytics/bases/gcids.json";
    $gcids = json_decode(file_get_contents($gcidsFile), true);

    if($gcid != "Отсутствует" && $gcids["gcids"][$gcid]) {
      $n_timestamp = 1;
      foreach($gcids["gcids"][$gcid] as $phone=>$webhooks) {
        foreach($webhooks as $webhook) {
          foreach($webhook as $timestamp=>$status) {
            if($timestamp > $n_timestamp) {
              $n_timestamp = $timestamp;
              $userPhone = $phone;
            }
          }
        }
      }
    }

    if($userPhone == '' || $gcid == "Отсутствует") $userPhone = 'Отсутствует';
    unset($gcid);
    return $userPhone;
  }
?>