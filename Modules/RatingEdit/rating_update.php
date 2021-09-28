<?php
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции сайта

// Определяем добавление это ИЛИ обновление для голосования
$user_id = $_POST['user_id'];
$creative_id = $_POST['creative_id'];
$creative_grade_pos = $_POST['creative_grade_pos'];
$creative_comment_content = $_POST['creative_comment_content'];


// Функция провекри позиции ()
function GetGradesDataCount($pdo, $creative_id, $user_id){
	$stmt = $pdo->prepare("SELECT * FROM сreative_grades WHERE creative_id = :creative_id AND user_id = :user_id");
	$stmt->execute(array(
		'creative_id'=>$creative_id,
		'user_id'=>$user_id
	));
	return $stmt->rowCount();
}

if(GetGradesDataCount($pdo, $creative_id, $user_id) > 0){
	// Если такая запись существовала - апдейтим ее
	$stmt = $pdo->prepare("UPDATE сreative_grades SET creative_grade_pos = :creative_grade_pos WHERE creative_id = :creative_id AND user_id = :user_id");
	$stmt->execute(array(
		'creative_grade_pos'=>$creative_grade_pos,
		'creative_id'=>$creative_id,
		'user_id'=>$user_id
	));
	$infoTag = "Обновили";
}else{
	// Если нет - создаем
	$stmt = $pdo->prepare("INSERT INTO сreative_grades SET user_id = :user_id, creative_id = :creative_id, creative_grade_pos = :creative_grade_pos");
	$stmt->execute(array(
		'user_id'=>$user_id,
		'creative_id'=>$creative_id,
		'creative_grade_pos'=>$creative_grade_pos
	));
	$infoTag = "Добавили";

}

// Получить коментарий
if($_POST['creative_comment_content'] != ""){
	
	$stmt = $pdo->prepare("INSERT INTO сreative_сomments SET user_id = :user_id, creative_id = :creative_id, creative_comment_content = :creative_comment_content");
	$stmt->execute(array(
		'user_id'=>$user_id,
		'creative_id'=>$creative_id,
		'creative_comment_content'=>$creative_comment_content
	));
	
	$infoTag .= " Записали комментарий";
}else{
	$infoTag .= " Нет комментария";
}

echo ">> ".$infoTag;

?>