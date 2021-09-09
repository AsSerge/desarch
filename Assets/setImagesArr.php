<?php
require_once ("source.php");
header('Content-Type: application/x-javascript; charset=utf8');
// Получаем ID креатива
$TaskID = $_GET['TaskID'];


// Функция получения массива файлов-изображений из заданной папки
function GetImagesArr($dir, $id){
	$file = [];
	$sc_dir = "../".$dir."/".$id;
	$files = scandir($sc_dir);
	foreach ($files as $values){
		// Выводим только файлы-изображения JPEG
		if($values != "." AND $values != ".."){
			if(exif_imagetype($sc_dir."/".$values) == IMAGETYPE_JPEG ){
				$file[] = "/".$dir."/".$id."/".$values;
			}	
		}
	}
	return $file; 
}
// Формируем массив базовых исзобажений для задачи
$cr_files = GetImagesArr(TASK_BASE_DIR, $TaskID);
// Формируем JSON
echo json_encode($cr_files);
?>