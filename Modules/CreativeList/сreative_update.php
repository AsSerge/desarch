<?php
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции и настройки сайта
if (isset($_POST['creative_id'])){
	$creative_id = $_POST['creative_id'];

	$stmt = $pdo->prepare("UPDATE сreatives SET creative_status = :creative_status WHERE creative_id = :creative_id");
	$stmt->execute(array(
	'creative_status' => 'В работе',
	'creative_id' => $creative_id	
	));
	// Необходимо создать папку для хранения креатива, взятого в работу!!!!
	// Папка для креатива создается при первом принятии креатива в работу

	// Создаем папку в /Creatives/ с именем индекса. В дальнейшем все, касающееся креативы и исходники будет храниться в этой папке
	if(!is_dir(CREATIVE_FOLDER.$creative_id)){ 
		mkdir(CREATIVE_FOLDER.$creative_id, 0777);
	}
}
?>