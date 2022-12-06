<?php

// Load Composer's autoloader
require 'vendor/autoload.php';
//Include required PHPMailer files
require './lib/phpmailer/PHPMailer.php';
require './lib/phpmailer/SMTP.php';
require './lib/phpmailer/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generate_otp(){
    return rand(100000, 999999);
}

//Method to generate verification code and pass targeted page and url parameter
function generate_link(){
    return md5(rand());
}

// Validate account data
function is_valid_mail($m){
    if (!filter_var($m, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else{
        return true;
    } 
}
function is_valid_data($arr){
    if (!filter_var($arr[0], FILTER_VALIDATE_EMAIL)) {
        return("Invalid email address");
    } elseif (!preg_match('/^[A-Za-z]{3,50}$/', $arr[1])) {
        return("Invalid username");
    } elseif ($arr[2] < 6) {
        return("Password is too short");
    } else {
        return "true";
    }
}

// Send email notification function
function mail_notify($c){
    $res = '';
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Port = "587";
	$mail->Username = "originaltechlimited@gmail.com";
	$mail->Password = "fphbfhmpwxvuddyl";
	$mail->Subject = $c['subject'];
	$mail->setFrom('no-reply@app.com');
	$mail->isHTML(true);
	// $mail->addAttachment('img/attachment.png');
	$mail->Body = $c['body'];
	$mail->addAddress($c['mail']);
	if ( $mail->send() ) {
		$res = "sent";
	}else{
		$res = "Message could not be sent. Mailer Error: ".$c['mail'];
	}
	$mail->smtpClose();
    return $res;
}
if(isset($_POST["getUser"])){
	echo "Working Directory Postfix";

}