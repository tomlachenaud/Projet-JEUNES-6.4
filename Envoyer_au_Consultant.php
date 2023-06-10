<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
$filename = $_SESSION['filename'];
$email = $_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailc = $_POST["mail"];
    $checkboxes = $_POST["checkbox"];
    $contenu="";
    foreach ($checkboxes as $checkbox) {
        $contenu .= $checkbox . "\n";
    }
$file=fopen($email."/Consultant.txt","w");
fwrite($file,$contenu);
fclose($file);
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
            $mail->addAddress($emailc);
            $mail->Subject = 'Consultation des Références ';
            $mail->Body = 'Cliquez sur le lien suivant pour accéder à la page Referent.php : http://localhost:8888/Consultant.php?&filename=' . urlencode($_SESSION['filename']) . '&email=' . urlencode($_SESSION['email']);

            if ($mail->send()) {
                echo 'L\'e-mail a été envoyé avec succès.';
            } else {
                echo 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail. Erreur : ' . $mail->ErrorInfo;
            }


            // Création du formulaire caché
            echo '<form id="hiddenForm" action="Consultant.php" method="GET" style="display:none;">';
            echo '<input type="hidden" name="email" value="'.$_SESSION["email"].'">';
            echo '<input type="hidden" name="filename" value="'.$_SESSION["filename"].'">';
            echo '</form>';
header ('Location: Jeune.php');
exit();
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Envoyer au Consultant</title>
        <link rel="icon" href="LOGO/LOGO 1.png">
        <link rel="stylesheet" href="Envoyer_au_Consultant.css">
    </head>
    <body>
    <div class="titre">
        <a href="Visiteurs.php"><img src="LOGO/LOGO 1.png" class="logo"></a>
        <div class="texte">JEUNE</div>
        <div class="soustexte">Je donne de la valeur à mon engagement</div>
        </div>
        <div class="boutons">
            <button class="jeune">JEUNE</button>
            <button class="referent">REFERENT</button>
            <button class="consultant">CONSULTANT</button>
            <form action="Partenaires.php">
            <button class="partenaires">PARTENAIRES</button>
            </form>
        </div>
        <div class="main">
            <div class="modifications">
        <div class="lister">
<form method="POST">

    <div class="form-group">
                            <label for="mail">EMAIL DU CONSULTANT :</label>
                            <input type="email" name="mail" required><br>
                        </div>
<br>   
                    REFERENCE VALIDÉE : 
                    <br>
<?php 
    // Ouvrir le fichier en mode lecture
    $file = fopen($email.'/referents.txt', 'r');
    // Tableau pour stocker les lignes du fichier
    $lines = array();

    // Lire le fichier ligne par ligne jusqu'à la fin
    while (($line = fgets($file)) !== false) {
                // Supprime les espaces en début et fin de ligne
                $line = trim($line);
        // Vérifie si la ligne n'est pas vide
        if (!empty($line)) {
            $lines[] = $line; // Ajoute la ligne au tableau
        }
    }
    // Fermer le fichier
    fclose($file);

    foreach ($lines as $checkbox) {
        $ref = fopen($checkbox . '/' . $checkbox . '.txt', 'r');
        if ($ref) {
            $namer = fgets($ref);
            $prenomr = fgets($ref);
            fclose($ref);
            if (file_exists($checkbox.'/valide.txt')){
            echo "<br> <input type='checkbox' name='checkbox[]' value='$checkbox' class='check'>";
            echo "$namer $prenomr<br>";
    }
}
    }

?>
<br>
                    <input type="submit" value="Envoyer au consultant" class="soumettre" >

</form>
</div>
</div>
</div>
</body>
</html>

