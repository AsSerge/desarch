<?php
// Удаление картинки из папки
require_once ("source.php");
header('Content-Type: application/x-javascript; charset=utf8');
$ImgToDel = $_GET['ImgToDel'];

if($ImgToDel != ""){
	$ImgToDel = '..'.$ImgToDel;
	unlink($ImgToDel);
}

?>