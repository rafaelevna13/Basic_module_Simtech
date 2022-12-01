<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

$mail = new PHPMailer; 
$mail->CharSet = 'UTF-8';     

// Настройки SMTP
$mail->isSMTP();        //Send using SMTP
$mail->SMTPAuth = true; //Enable SMTP authentication
$mail->SMTPDebug = 0;   //Enable verbose debug output(Включить подробный отладочный вывод)
 
$mail->Host = 'ssl://smtp.yandex.ru';           //Set the SMTP server to 
$mail->Port = 465;                              //TCP port to connect to; 
$mail->Username = 'rafaelevna13a@yandex.ru';    //SMTP username
$mail->Password = 'pftqrewxxlgtyher';           //SMTP password

// От кого
$mail->setFrom('rafaelevna13a@yandex.ru', 'response');		
 
// Кому
$mail->addAddress('rafaelevna13a@yandex.ru', 'contact_us');

// Тема письма
$subject = "Client:" . $first_name . " " . $last_name . " filled out the form and is waiting for help" ;
$mail->Subject = $subject; 
 
// Тело письма
$body = '<p><strong>Customer contact details</strong></p>
<ul>
    <li>Phone number: ' . $phone_number .'</li>
    <li>Email address: ' . $email_address .'</li>
</ul>
<hr>
<ul>
    <li><i>Gender: ' . $gender .'</i></li>
    <li><i>Communication method: ' . $communication_method .'</i></li>
    <li><i>Subscribe to news and notifications: ' . $notifications .'</i></li>
    <li><i>Description of the problem: ' . $problem .'</i></li>
</ul>';
$mail->msgHTML($body);
 
$mail->send();

?>
