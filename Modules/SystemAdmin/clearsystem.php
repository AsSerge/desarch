<?php
echo "Очистка системы";
// Первоначальная очистка системы
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo
include_once($_SERVER['DOCUMENT_ROOT']."/Layout/settings.php"); // Функции сайта


$stmt = $pdo->prepare("TRUNCATE TABLE tasks");
$stmt->execute();


$stmt = $pdo->prepare("TRUNCATE TABLE designes");
$stmt->execute();

$stmt = $pdo->prepare("TRUNCATE TABLE сreatives");
$stmt->execute();

$stmt = $pdo->prepare("TRUNCATE TABLE сreative_grades");
$stmt->execute();

$stmt = $pdo->prepare("TRUNCATE TABLE сreative_сomments");
$stmt->execute();


// Функция очистки каталога с подкаталогами
function unlinkRecursive($dir, $deleteRootToo){
	if(!$dh = @opendir($dir))
	{
		return;
	}
	while (false !== ($obj = readdir($dh)))
	{
		if($obj == '.' || $obj == '..')
		{
			continue;
		}

		if (!@unlink($dir . '/' . $obj))
		{
			unlinkRecursive($dir.'/'.$obj, true);
		}
	}
	closedir($dh);
	if ($deleteRootToo)
	{
		@rmdir($dir);
	}
	return;
}
?>