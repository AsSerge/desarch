<?php
// Создание новой задачи
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции сайта

if (isset($_POST['add_task']) and $_POST['add_task'] == true){
	$user_id = $_POST['user_id'];
	$customer_id = $_POST['customer_id'];
	$task_number = $_POST['task_number'];
	$task_name = $_POST['task_name'];
	$task_setdatetime = date_to_mysql($_POST['datepicker_start']);
	$task_deadline = date_to_mysql($_POST['datepicker_end']);
	$task_description = $_POST['task_description'];
	$task_status = "Поставлена";

		
	$stmt = $pdo->prepare("INSERT INTO tasks SET 
		task_setdatetime = :task_setdatetime,
		task_deadline = :task_deadline,
		user_id = :user_id,
		customer_id = :customer_id,
		task_name = :task_name,
		task_number = :task_number,
		task_status = :task_status,
		task_description = :task_description
		");
	
	$stmt->execute(array(
		'task_setdatetime' => $task_setdatetime,
		'task_deadline' => $task_deadline,
		'user_id' => $user_id,
		'customer_id' => $customer_id,
		'task_name' => $task_name,
		'task_number' => $task_number,
		'task_status' => $task_status,
		'task_description' => $task_description
	));

	// Получаем индекс последней добавленной задачи
	$last_index = $pdo->lastInsertId();
	// Создаем папку в /Tasks/ с именем индекса. В дальнейшем все, касающееся задачи будет храниться в этой папке 
	mkdir(TASK_FOLDER.$last_index, 0777);
}
?>