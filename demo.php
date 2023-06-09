<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Start the session
session_start();

// Check if the form has already been submitted three times
if (isset($_SESSION['form_submissions']) && $_SESSION['form_submissions'] >= 3) {
    echo json_encode(["status" => 0, "message" => "Maximum form submissions reached"]);
    exit();
}

// Increment the submission count in the session
if (!isset($_SESSION['form_submissions'])) {
    $_SESSION['form_submissions'] = 1;
} else {
    $_SESSION['form_submissions']++;
}

echo json_encode($_POST);
$name = $_POST['name'];
$Email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.fastmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'mail@meespost.nl'; //SMTP username
    $mail->Password = 'tsn4zneemeddrg6k'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mail@meespost.nl', 'Mees');
    $mail->addAddress('mail@meespost.nl', 'Mees'); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = $subject;
    $body = "name: " . $name . "<br>";
    $body .= "Email: " . $Email . "<br>";
    $body .= "message: " . $message;

    $mail->Body = $body;

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = $subject;

    $body = "name: " . $name . "<br>";
    $body .= "Email: " . $Email . "<br>";
    $body .= "message: " . $message;

    $result = ["status" => 0, "message" => ""];
    if ($mail->send()) {
        $result["status"] = 1;
    } else {
        $result["status"] = 0;
        $result["message"] = $mail->ErrorInfo;
    }

    echo json_encode($result);

} catch (Exception $e) {
    $result["status"] = 0;
    $result["message"] = $mail->ErrorInfo;
    echo json_encode($result);
}

?>