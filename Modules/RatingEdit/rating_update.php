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
	if($creative_grade_pos == "on"){
		// Если креатив утверждается членом комиссии
		$stmt = $pdo->prepare("UPDATE сreative_grades SET creative_grade_pos = :creative_grade_pos WHERE creative_id = :creative_id AND user_id = :user_id");
		$stmt->execute(array(
			'creative_grade_pos'=>$creative_grade_pos,
			'creative_id'=>$creative_id,
			'user_id'=>$user_id
		));
		$infoTag = "Обновили";
	}else{
		// Если креатив Отклоняется членом комиссииии - ВСЕ результаты голосования по нему обнуляются и креативу присваиваеися статус "На доработке"
		$stmt = $pdo->prepare("DELETE FROM сreative_grades WHERE creative_id = ?");
		$stmt->execute(array($creative_id));
		$infoTag = "Удалили!";

		$stmt = $pdo->prepare("UPDATE сreatives SET creative_status = :a WHERE creative_id =:b");
		$stmt->execute(array(
			'a'=>'На доработке',
			'b'=>$creative_id
		));
	}

}else{
	// Если нет - создаем
	if($creative_grade_pos == "on"){
		$stmt = $pdo->prepare("INSERT INTO сreative_grades SET user_id = :user_id, creative_id = :creative_id, creative_grade_pos = :creative_grade_pos");
		$stmt->execute(array(
			'user_id'=>$user_id,
			'creative_id'=>$creative_id,
			'creative_grade_pos'=>$creative_grade_pos
		));
		$infoTag = "Добавили";
	}else{
		// Если креатив Отклоняется членом комиссииии - ВСЕ результаты голосования по нему обнуляются и креативу присваиваеися статус "На доработке"
		$stmt = $pdo->prepare("DELETE FROM сreative_grades WHERE creative_id = ?");
		$stmt->execute(array($creative_id));
		$infoTag = "Удалили все предыдущие записи!";

		$stmt = $pdo->prepare("UPDATE сreatives SET creative_status = :a WHERE creative_id =:b");
		$stmt->execute(array(
			'a'=>'На доработке',
			'b'=>$creative_id
		));
	}

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