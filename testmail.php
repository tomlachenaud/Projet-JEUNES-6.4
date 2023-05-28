<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['envoyer'])) {
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = 'projeune64@gmail.com';
    $mail->Password = 'npvxnfshfmpmdeqn';

    $mail->setFrom('projeune64@gmail.com');
    $mail->addReplyTo('projeune64@gmail.com');
    $mail->addAddress('tomlachenaud@gmail.com');

    $mail->Subject = 'PHPMailer GMail SMTP test';
    $mail->Body = "http://localhost:8888/Consultant.php?";

    if ($mail->send()) {
        echo 'L\'e-mail a été envoyé avec succès.';
    } else {
        echo 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail. Erreur : ' . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Envoi d'e-mail via Gmail et PHPMailer</title>
</head>
<body>
    <h1>Envoi d'e-mail via Gmail et PHPMailer</h1>

    <form method="post">
        <input type="submit" name="envoyer" value="Envoyer l'e-mail">
    </form>
</body>
</html>
