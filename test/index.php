<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
use Bitrix\Main\Page\Asset;
    Asset::getInstance()->addJs("/local/js/script.js");
?>
<div id="app">

</div>
<script>
    new SectionAdd({});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>