<?
// Страница авторизации

// Функция для генерации случайной строки
function generateCode($length=6) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;
	while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)];
	}
	return $code;
}

// Соединямся с БД
include_once($_SERVER['DOCUMENT_ROOT']."/Login/classes/dbconnect.php"); //$pdo

if(isset($_POST['submit']))
{
	// Вытаскиваем из БД запись, у которой логин равняеться введенному

	$user_login = ClearSQLString($_POST['login']);
	$user_login = $pdo->quote($user_login);
	
	$query = $pdo->prepare("SELECT * FROM users WHERE `user_login` = {$user_login}");
	$query->execute();
	$data = $query->fetch(PDO::FETCH_LAZY);

	// Сравниваем пароли
	if($data['user_password'] === md5(md5($_POST['password'])))
	{
		// Генерируем случайное число и шифруем его
		$hash = md5(generateCode(10));

		// Записываем в БД новый хеш авторизации и IP
		$query = $pdo->prepare("UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");
		$query->execute();		

		// Ставим куки
		setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
		setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

		// Переадресовываем браузер на страницу проверки нашего скрипта
		header("Location: check.php"); exit();
	}
	else
	{
		echo "<div class='pass_error'><div>Вы ввели неправильный логин или пароль</div></div>";
	}
}
?>
<!doctype html>
<html lang="ru">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/datatables.min.css">	
	<link rel="stylesheet" href="/css/dataTables.bootstrap4.min.css">	
	<link rel="stylesheet" href="/css/style.css">

	<title>Вход в систему</title>
<style>
html,
body {
	height: 100%;
}

body {
	display: -ms-flexbox;
	display: flex;
	-ms-flex-align: center;
	align-items: center;
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}

.pass_error{
    width: 100%;
    height: 10%;
    position: absolute;
    top: 0;
    left: 0;
    overflow: auto;
    background: none;
    border: none;
    outline: none;
}

.pass_error div{
	display: inline-block;
	font-weight: 600;
	color: red;
}

.form-signin {
	width: 100%;
	max-width: 330px;
	padding: 15px;
	margin: auto;
}
.form-signin .checkbox {
	font-weight: 400;
}
.form-signin .form-control {
	position: relative;
	box-sizing: border-box;
	height: auto;
	padding: 10px;
	font-size: 16px;
}
.form-signin .form-control:focus {
	z-index: 2;
}
.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
</head>
<body class="text-center">

<form class="form-signin" method="POST">
	<img class="mb-4" src="/images/brand/DMT_LOGO.svg" alt="logo" width="70">
	<h1 class="h4 mb-3 font-weight-normal">Авторизация</h1>
	<label for="inputEmail" class="sr-only">Email address</label>
	<input type="email" id="inputEmail" name="login" class="form-control" placeholder="Email адрес" required autofocus>
	<label for="inputPassword" class="sr-only">Password</label>
	<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
	<p class="mt-2 mb-2 text-muted"><a href = "#">Я забыл пароль</a></p>
	<button class="btn btn-md btn-primary btn-block" name="submit" type="submit">Вход</button>
	<p class="mt-3 mb-2 text-muted"><a href = "http://www.dmtextile.ru" target="_blanc">&copy; Dmtextile 2021</a></p>
</form>
	
	<script src = "/js/jquery-3.6.0.min.js"></script>
	<script src = "/js/popper.min.js"></script>
	<script src = "/js/bootstrap.min.js"></script>
	<script src = "/js/datatables.min.js"></script>
	<script src = "/js/dataTables.bootstrap4.min.js"></script>	
	<script src = "/js/custom.js"></script>
</body>
</html>
