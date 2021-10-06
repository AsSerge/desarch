<?php
// Утверждение креатива
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции сайта
 $creative_id = $_POST['creative_id'];

// Получение массива хэш-тегов
$stmt = $pdo->prepare("SELECT * FROM hash_tags WHERE 1");
$stmt->execute();
$hash_tags_array = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt_used = $pdo->prepare("SELECT creative_hash_list  FROM сreatives WHERE creative_id = ?");
$stmt_used->execute(array($creative_id));
$result = $stmt_used->fetch(PDO::FETCH_ASSOC);
$result = explode("-", $result['creative_hash_list']);
 // Возвращаем все теги без использованых
$itog = [];
foreach ($hash_tags_array as $i){
	if (!in_array($i['hash_id'] , $result)){
		$itog[$i['hash_id']] = $i['hash_name']; 
	}
};
echo json_encode($itog);
?>