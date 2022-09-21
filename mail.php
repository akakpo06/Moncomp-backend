<?php

    require_once "headers.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once "vendor/autoload.php";

    $mail = new PHPMailer(true);
                  
    $message = json_decode(file_get_contents("php://input"));

        //PHP mailer config.
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'c55e9ab9c1500f';
    $mail->Password = '6f6bca84fe3e3a';                                

    
    // Setting message
    $senderName = $message->surname . " " . $message->name;
    $mail->setFrom($message->email, $senderName);
    $mail->addAddress("name@example.com");


    $mail->Subject = $message->subject;
    $mail->Body = $message->body;

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

?>