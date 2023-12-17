<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include("sqlcon.php");

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$sql = "SELECT resumecopy, emailid FROM `tbljobappln` WHERE jobapplid = (SELECT max(jobapplid) FROM tbljobappln)";
$result = mysqli_query($con, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);

  $resumecopy = $row['resumecopy'];
  $email = $row['emailid'];
} else {
  echo "Error retrieving data from database.";
  die();
}
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mmazumder201285@bscse.uiu.ac.bd';                     //SMTP username
    $mail->Password   = '2011107016';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mmazumder201285@bscse.uiu.ac.bd', 'Admin');
    $mail->addAddress($email);     //Add a recipient
    $mail->addReplyTo('mmazumder201285@bscse.uiu.ac.bd', 'Admin');

    //Attachments
        $mail->addAttachment($resumecopy);         //Add attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your Application is submitted';
    $mail->Body    = 'Please check your <b>Resume</b> in the attatchment. You will hear from us soon';
    $mail->AltBody = 'Please check your <b>Resume</b> in the attatchment';

    $mail->send();
    echo "Message sent...";
    header('location: ' . $_SERVER['HTTP_REFERER']);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}