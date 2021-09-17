<?php
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
if (isset($_POST['creative_id'])){
	$creative_id = $_POST['creative_id'];

	$stmt = $pdo->prepare("UPDATE сreatives SET creative_status = :creative_status WHERE creative_id = :creative_id");
	$stmt->execute(array(
	'creative_status' => 'В работе',
	'creative_id' => $creative_id	
	));
	// Необходимо создать папку для хранения креатива, взятого в работу
}
?>