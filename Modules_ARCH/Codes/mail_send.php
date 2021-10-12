<?php
include('../../Assets/PHPMailer/PHPMailerFunction.php');
// $mail - Адрес получателя
// $subject - Тема сообщения
// $message - Сообщение
// $sender_mail - Почта отправителя
// $sender_name - Имя отправителя

$mail = 'z00m.serge@gmail.com';
$subject = 'Это третье тестовое письмо из PHP Mailer';
$message = 'Привет';
$sender_mail = 'Tsvetkov-SA@grmp.ru';
$sender_name = 'Цветков Сергей';

SendMailGRMP($mail, $subject, $message, $sender_mail, $sender_name);

?>