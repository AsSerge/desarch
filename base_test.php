<?php
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Настройки сайта

// Функция получения максимального номера дизайна для формирования имени каталога
function GetNewFolderName($pdo){
	$stmt = $pdo->prepare("SELECT MAX(design_id) FROM designes WHERE 1");
	$stmt->execute();
	$result = $stmt->fetchColumn();
	return $result;
}

$base_name = (GetNewFolderName($pdo)) ? GetNewFolderName($pdo) : '1';

if (!file_exists(DESIGN_FOLDER.$base_name)) {
	mkdir(DESIGN_FOLDER.$base_name, 0777, true);
}

$base_name;

?>
