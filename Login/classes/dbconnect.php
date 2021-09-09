<?php
$HOST = 'localhost';
$DB = 'desarch';
$TABLE = 'users';
$USER = 'root';
$PASSWORD = 'root';
$CHARSET = 'utf8';

$dsn = "mysql:host=$HOST;dbname=$DB;charset=$CHARSET";
$opt = [
	PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES		=> false,
	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
];

$pdo = new PDO($dsn, $USER, $PASSWORD, $opt);

function ClearSQLString($string){
	$eitem = array('strong','lt','gt','sub','&','amp', ";", "/","\r\n", "\n", "\r");
	$string = htmlentities(htmlspecialchars($string));
	$string = str_replace($eitem, "", $string);
	$string = trim($string);
	return $string;
}

?>