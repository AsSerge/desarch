<?php
// Скрипт загрузки исходников в библиотеку
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Настройки сайта
$creative_id = $_POST['creative_id'];
$user_id = $_POST['user_id'];
$design_name = $_POST['design_name'];
$design_source_url = $_POST['design_source_url'];
$design_creative_style = $_POST['design_creative_style'];

// Функция вставки информации о НОВОМ дизайне в базу
function InsertDesignInfo($pdo, $creative_id, $user_id, $design_name, $design_source_url, $design_creative_style){
	$stmt = $pdo->prepare("INSERT INTO designes SET creative_id = :creative_id, user_id = :user_id, design_name = :design_name, design_source_url = :design_source_url, design_creative_style = :design_creative_style");
	$stmt->execute(array(
		'creative_id'=>$creative_id,
		'user_id'=>$user_id,
		'design_name'=>$design_name,
		'design_source_url'=>$design_source_url,
		'design_creative_style'=>$design_creative_style
	));

	$pdo->lastInsertId(); // Возвращает номер последней добавленной записи
}



// echo InsertDesignInfo($pdo, $creative_id, $user_id, $design_name, $design_source_url, $design_creative_style);




// include_once($_SERVER['DOCUMENT_ROOT']."/Modules/LibraryEdit/FilesLoad.php"); // Модуль загрузки файлов

// echo $_POST['design_name'];
// print_r ($_FILES['file']['name']);

?>