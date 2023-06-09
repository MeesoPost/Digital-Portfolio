<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Refresh" content="0; url='http://576459.klas4s22.mid-ica.nl'" />
    <!-- Automatische doorverwijzing met een vertraging van 0 seconden naar de opgegeven URL -->


    <?php




    //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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
        $Email->email = $Email;
        $mail->Body = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    


        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }