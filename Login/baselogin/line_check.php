<?php
// Скрипт линейной проверки
// Соединямся с БД
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
	$query = $pdo->prepare("SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
	$query->execute();
	$userdata = $query->fetch(PDO::FETCH_LAZY);

	$user_id = $userdata['user_id']; // Роль пользователя
	$user_role = $userdata['user_role']; // Роль пользователя
	$user_name = $userdata['user_name']; // Имя пользователя
	$user_surname = $userdata['user_surname']; // Фамилия пользователя

	switch ($user_role){
		case "adm":
			$user_role_description = "Администратор";
			break;
		case "mgr":
			$user_role_description = "Постановщик задачи";
			break;
		case "dgr":
			$user_role_description = "Дизайнер";
			break;
		case "ctr":
			$user_role_description = "Проверяющий";
			break;	
	}
	
	if(($userdata['user_hash'] !== $_COOKIE['hash']) and ($userdata['user_id'] !== $_COOKIE['id']))
	{
		setcookie("id", "", time() - 3600*24*30*12, "/");
		setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
		
		// Переадресовываем браузер на страницу логирования
		header("Location: /"); exit;

	}
}else{
	header("Location: ../Login/baselogin/login.php"); exit;
}
?>