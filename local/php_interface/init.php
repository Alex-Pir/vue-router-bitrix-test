<?session_start(); 

AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate","DoNotUpdateSection");	
function DoNotUpdateSection(&$arFields)
{	
	if ($_REQUEST['mode']=='import')
	{

$log = date('Y-m-d H:i:s') . ' работа функции DoNotUpdateSection данные каталога '.$arFields['NAME'].' были затерты' ;		
		unset($arFields['NAME']);
		unset($arFields['IBLOCK_SECTION_ID']);
		unset($arFields['ACTIVE']);
file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);		
	}
}	

AddEventHandler("iblock", "OnBeforeIBlockSectionAdd","DoNotAddSection");	
function DoNotAddSection(&$arFields)
{	
	if ($_REQUEST['mode']=='import')
	{

$log = date('Y-m-d H:i:s') . ' работа функции DoNotAddSection добавлен каталог '.$arFields['NAME'];	
		$arFields['ACTIVE'] = "N";
file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
	}
}	
	

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate","DoNotUpdate");
function DoNotUpdate(&$arFields)
{
    if ($_REQUEST['mode']=='import')
    { 

$log = date('Y-m-d H:i:s') . ' работа функции DoNotUpdate найден товар '.$arFields['NAME'];

        unset($arFields['PREVIEW_PICTURE']);
        unset($arFields['DETAIL_PICTURE']);
        unset($arFields['PREVIEW_TEXT']);
        unset($arFields['DETAIL_TEXT']);
		unset($arFields['NAME']);
		unset($arFields['ACTIVE']);
		unset($arFields['IBLOCK_SECTION_ID']);
		unset($arFields['IBLOCK_SECTION']);

file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);		
		}

}
AddEventHandler("iblock", "OnBeforeIBlockElementAdd","DoNotAdd");
function DoNotAdd(&$arFields)
{
    if ($_REQUEST['mode']=='import')
    {
		
$log = date('Y-m-d H:i:s') . ' работа функции DoNotAdd добавлен товар '.$arFields['NAME'];

        unset($arFields['CPREVIEW_PICTURE']);
        unset($arFields['DETAIL_PICTURE']);
        unset($arFields['PREVIEW_TEXT']);
		unset($arFields['DETAIL_TEXT']);

		$arFields['ACTIVE'] = "N";
		$arFields['SORT'] = 1000;
		$arFields['IBLOCK_SECTION_ID'] = 16;
		$arFields['IBLOCK_SECTION'] = 16;

		unset($arFields['PROPERTY_VALUES'][5]); 
		unset($arFields['PROPERTY_VALUES'][35]); 
		unset($arFields['PROPERTY_VALUES'][32]); 
		unset($arFields['PROPERTY_VALUES'][33]); 
		unset($arFields['PROPERTY_VALUES'][34]); 
		unset($arFields['PROPERTY_VALUES'][42]); 
		unset($arFields['PROPERTY_VALUES'][40]); 
		unset($arFields['PROPERTY_VALUES'][41]); 
		unset($arFields['PROPERTY_VALUES'][39]);
		unset($arFields['PROPERTY_VALUES'][38]);		
		unset($arFields['PROPERTY_VALUES'][6]); 
		unset($arFields['PROPERTY_VALUES'][7]); 
		unset($arFields['PROPERTY_VALUES'][14]); 
		unset($arFields['PROPERTY_VALUES'][36]); 
		unset($arFields['PROPERTY_VALUES'][37]); 
		unset($arFields['PROPERTY_VALUES'][49]); 	
		unset($arFields['PROPERTY_VALUES'][50]); 
		unset($arFields['PROPERTY_VALUES'][51]); 
		unset($arFields['PROPERTY_VALUES'][52]); 
		unset($arFields['PROPERTY_VALUES'][53]); 
		unset($arFields['PROPERTY_VALUES'][54]); 
		unset($arFields['PROPERTY_VALUES'][55]); 
		unset($arFields['PROPERTY_VALUES'][56]); 
		unset($arFields['PROPERTY_VALUES'][57]); 
		unset($arFields['PROPERTY_VALUES'][71]); 
		unset($arFields['PROPERTY_VALUES'][72]); 
		unset($arFields['PROPERTY_VALUES'][73]);
		unset($arFields['PROPERTY_VALUES'][74]); 
		unset($arFields['PROPERTY_VALUES'][75]); 
		unset($arFields['PROPERTY_VALUES'][76]); 
		unset($arFields['PROPERTY_VALUES'][77]); 
		unset($arFields['PROPERTY_VALUES'][78]); 
		unset($arFields['PROPERTY_VALUES'][79]);
file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
    }
}


AddEventHandler("iblock", "OnBeforeIBlockPropertyUpdate","DoNotUpdateProperty");	
function DoNotUpdateProperty(&$arFields)
{	
	if ($_REQUEST['mode']=='import')
	{
		unset($arFields['NAME']);
	}
}
	




  function getUserPhone() {
    $gcid = "Отсутствует";
    if (isset($_COOKIE['_ga'])) {
      list($version,$domainDepth, $cid1, $cid2) = explode('[\.]', $_COOKIE["_ga"],4);
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

    $gcidsFile  = $_SERVER['DOCUMENT_ROOT']."/local/dspanalytics/bases/base_gcids.json";
    $gcids      = json_decode(file_get_contents($gcidsFile), true);
    $phonesFile = $_SERVER['DOCUMENT_ROOT']."/local/dspanalytics/bases/base_phones.json";
    $phones     = json_decode(file_get_contents($phonesFile), true);
    $agentsFile = $_SERVER['DOCUMENT_ROOT']."/local/dspanalytics/bases/base_agents.json";
    $agents     = json_decode(file_get_contents($agentsFile), true);

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
session_write_close();  
?>