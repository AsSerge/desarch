<?php
// УСТАНОВКИ САЙТА

// Варианты типов заказчиков
$array_customer_types=array(
	'Розница',
	'Сети',
	'Опт',
	'Китаева'
);
$customer_types = json_encode($array_customer_types);


// Статусы креативов
$creative_status_types=array(
	'В задаче',
	'В работе',
	'На утверждении',
	'Принят'
);


// Варианты типов креативов (принты)
$array_creative_style = array(
	'растительный',
	'геометрический',
	'классический',
	'персонажи',
	'абстрактный',
	'анималистический',
	'тематическая атрибутика'
);


// Констаннты сайта
define("TASK_FOLDER", $_SERVER['DOCUMENT_ROOT']."/Tasks/"); // Каталог для задач (номера папок по ID задачи)


// Функции сайта
//Преобразуем дату в правильный MySql формат
function date_to_mysql($date){
	$date_tmp = explode(".",$date);
	$dete_new = $date_tmp[2]."-".$date_tmp[1]."-".$date_tmp[0];
	return $dete_new;
}

function mysql_to_date($date){
	$date_tmp = explode("-",$date);
	$dete_new = $date_tmp[2].".".$date_tmp[1].".".$date_tmp[0];
	return $dete_new;
}
?>