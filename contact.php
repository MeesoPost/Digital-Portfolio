<?php
$to = "576459@edu.rocmn.nl"; // Your email address here
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$headers = "From: " . $name . " <" . $email . ">\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
?>

<?php
if (isset($_POST['submit'])) {
    mail($to, $subject, $message, $headers);
    echo "<p>Your message was sent successfully. Thank you!</p>";
}
?>