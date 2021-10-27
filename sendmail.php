<?php 

use PHPMailer\PHPMailer\PHPMAiler;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$email = new PHPMailer(true);
$email->CharSet = 'UTF-8';
$email->setLanguage('ru', 'phpmailer/language/');
$email->IsHTML(true);

//от кого письмо
$mail-.setFrom('@', '');
//Кому отправлять
$mail->addAddress('@');
//Тема письма
$mail->Subject = '';

//Рука
$hand = "Правая";
if($_POST['hand'] == "left"){
   $hand = "Левая";
}

//Тело письма
$body = '<h1>Встречайте письмо</h1>'; 

if(trim(!empty($_POST['name']))){
   $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['email']))){
   $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
}
if(trim(!empty($_POST['hand']))){
   $body.='<p><strong>Рука:</strong> '.$hand.'</p>';
}
if(trim(!empty($_POST['age']))){
   $body.='<p><strong>Возраст:</strong> '.$_POST['age'].'</p>';
}
if(trim(!empty($_POST['message']))){
   $body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
}

//Прикрепить файл
if (!empty($_FILES['image']['tmp_name'])) {
   //путь загрузки файла
   $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
   //грузим файл
   if(copy($_FILES['image']['tmp_name'], $filePath)){
      $fileAttach = $filePath;
      $body.='<p><strong>Фото в приложении</strong>';
      $mail->addAttachment($fileAttach);
   }
}

$mail->Body - $body;

//Отправляем
if (!$mail->send()) {
   $message = 'Данные отправлены!';
}

$responce = ['message' => $message];
header('Content-type: application/json');
echo json_encode($responce);

?>