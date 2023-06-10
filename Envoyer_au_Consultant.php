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
            $mail->Subject = 'Consultation des R&#233;f&#233;rences ';
            $mail->Body = 'Bonjour,
            
Un utilisateur souhaite partager avec vous ses informations via la plateforme "Projet JEUNES 6.4".
Vous ne connaissez pas la plateforme ? Voici une courte explication :
                
De quoi s\'agit-il ? 
D\'une opportunite : celle qu\'un engagement quel qu\'il soit puisse etre considerer a sa juste valeur ! Toute experience est source d\'enrichissement et doit d\'etre reconnu largement. Elle revele un potentiel, l\'expression d\'un savoir-etre a concretiser.
            
A qui s\'adresse-t\'il ? 
A vous, jeunes entre 16 et 30 ans, qui vous etes investis spontanement dans une association ou dans tout type d\'action formelle ou informelle, et qui avez partage de votre temps, de votre energie, pour apporter un soutien, une aide, une competence.
A vous,responsables de structures ou referents d\'un jour, qui avez croise la route de ces jeunes et avez beneficie même ponctuellement de cette implication citoyenne ! C\'est l\'occasion de vous engager a votre tour pour ces jeunes en confirmant leur richesse pour en avoir ete un temps les temoins mais aussi les beneficiaires !
A vous, employeurs, recruteurs en ressources humaines, representants d\'organismes de formation, qui recevez ces jeunes, pour un emploi, un stage, un cursus de qualification, pour qui le savoir-etre constitue le premier fondement de toute capacite humaine.

Alors si vous souhaitez consulter les informations du Jeune qui vous contacte, cliquez sur le lien suivant : http://localhost:8888/Consultant.php?&filename=' . urlencode($_SESSION['filename']) . '&email=' . urlencode($_SESSION['email']);

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
                    <u>REFERENCE VALIDÉE</u> : 
                    <br>
                    <br>
                    Veuillez chosir la/les références a envoyer au Consultant !
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
                echo "<div class='textetab'>";
            echo "<br> <input type='checkbox' name='checkbox[]' value='$checkbox' class='check'>";
            echo "$namer $prenomr<br>";
            echo "</div>";
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

