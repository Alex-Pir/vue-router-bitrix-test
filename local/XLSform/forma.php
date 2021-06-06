<?php
	function dirRemove( $dirPath ) {
		$list = scandir( $dirPath );
		array_shift( $list );
		array_shift( $list );
		$paths = array();
		foreach ($list as $key => $file) {
			if ( is_dir( $dirPath.'/'.$file ) ) {
				dirRemove( $dirPath.'/'.$file );
				rmdir( $dirPath.'/'.$file );
			} else {
				unlink( $dirPath.'/'.$file );
			}
		}
	}
	$path = __DIR__.DIRECTORY_SEPARATOR.'forma';
	require_once( "$path/pclzip.lib.php" );
	$val1 = isset( $_POST['name'] ) || isset( $_GET['name'] ) ? ( isset( $_POST['name'] ) ? $_POST['name'] : $_GET['name']  ) : '';
	$val2 = isset( $_POST['phone'] ) || isset( $_GET['phone'] ) ? ( isset( $_POST['phone'] ) ? $_POST['phone'] : $_GET['phone']  ) : '';
	$val3 = isset( $_POST['email'] ) || isset( $_GET['email'] ) ? ( isset( $_POST['email'] ) ? $_POST['email'] : $_GET['email']  ) : '';
	$roistat_visit =  isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : '';
	$ip = $_SERVER['REMOTE_ADDR'];

if (isset($_COOKIE['_ga'])) {
	list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
	$contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1.'.'.$cid2);
	$cid = $contents['cid'];

}
else $cid = 'no cid';

$code = 'xlsx-'.md5("$ip::$val1::$val2::".(date("U")+microtime(true)));
mkdir($path.'/'.$code);
$archive = new PclZip( $path.'/forma.xlsx' );
if ($archive->extract(PCLZIP_OPT_PATH, $path.'/'.$code) == 0) {
	die("Error : ".$archive->errorInfo(true));
}
$tmpFile = $path.'/'.$code.'/xl/sharedStrings.xml';
$fh = fopen( $tmpFile, 'r');
$strContent = fread( $fh, filesize($tmpFile) );
fclose( $fh );
$strContent = str_replace( array( '%ip%', '%val1%', '%val2%', '%cid%', '%val3%', '%roistat_visit%' ), array( $ip, $val1, $val2 , $cid, $val3, $roistat_visit), $strContent );
$fh = fopen( $tmpFile, 'w');
fwrite( $fh, $strContent );
fclose( $fh );
$tmpFile = $path.'/'.$code.'/result.zip';
$archive = new PclZip( $tmpFile );
if ($archive->create($path.'/'.$code, PCLZIP_OPT_REMOVE_PATH, $path.'/'.$code) == 0)
	die("Error : ".$archive->errorInfo(true));

$fh = fopen( $tmpFile, 'r');
$strContent = fread( $fh, filesize($tmpFile) );
fclose( $fh );
unlink($tmpFile);
dirRemove($path.'/'.$code);
rmdir( $path.'/'.$code );
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment; filename="forma.xlsx"');
echo $strContent;
?>
