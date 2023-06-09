<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $emailJ = trim($_GET["email"]);
    $filenameJ = $emailJ . ".txt";
    $_SESSION['emailJ'] = $emailJ;
    $_SESSION['filenameJ'] = str_replace(' ', '', $filenameJ);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["date_naissance"]) && isset($_POST["mail"])) {
        // Récupération des valeurs soumises par le formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $dateNaissance = $_POST["date_naissance"];
        $email = $_POST["mail"];
        $phone = $_POST["phone"];
        $social = $_POST["social"];
        $presentation = $_POST["presentation"];
        $milieu = $_POST["milieu"];
        $duree = $_POST["duree"];
        $checkboxes = $_POST["checkbox"];

        // Validation des champs
        if (empty($nom) || empty($prenom) || empty($dateNaissance) || empty($email)) {
            echo "Veuillez remplir tous les champs obligatoires.";
        } else {
            // Création du nom de fichier basé sur l'adresse e-mail
            $filename = $email.".txt";

            // Création du contenu à écrire dans le fichier
            $contenu = $nom . "\n";
            $contenu .= $prenom . "\n";
            $contenu .= $dateNaissance . "\n";
            $contenu .= $phone . "\n";
            $contenu .= $email . "\n";
            $contenu .= $social . "\n";
            $contenu .= $presentation . "\n";
            $contenu .= $milieu . "\n";
            $contenu .= $duree . "\n";
            $cases='';
            foreach ($checkboxes as $checkbox) {
                $cases .= $checkbox . "\n";

        }
            if (!file_exists($email)){
            mkdir($email);
            }


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
            $mail->addAddress($email);
            $mail->Subject = 'Demande de référence';
            $mail->Body = 'Cliquez sur le lien suivant pour accéder à la page Referent.php : http://localhost:8888/Referent.php?&filename=' . urlencode($_SESSION['filenameJ']) . '&email=' . urlencode($_SESSION['emailJ']) . '&emailref=' . urlencode($email) . '&filenameref=' . urlencode($filename) .'';

            if ($mail->send()) {
                echo 'L\'e-mail a été envoyé avec succès.';
            } else {
                echo 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail. Erreur : ' . $mail->ErrorInfo;
            }

            file_put_contents($email . '/' . $filename, $contenu);
            $check=fopen($_SESSION['emailJ'] . '/' . "checkboxes.txt","w");
            if($check){
                fwrite($check,$cases);
                fclose($check);
            }
            file_put_contents($_SESSION["emailJ"].'/'. 'referents.txt', $email."\n", FILE_APPEND);

            // Création du formulaire caché
            echo '<form id="hiddenForm" action="Referent.php" method="GET" style="display:none;">';
            echo '<input type="hidden" name="email" value="'.$_SESSION["emailJ"].'">';
            echo '<input type="hidden" name="filename" value="'.$_SESSION["filenameJ"].'">';
            echo '<input type="hidden" name="emailref" value="'.$email.'">';
            echo '<input type="hidden" name="filenameref" value="'.$filename.'">';
            echo '</form>';
            header ('Location: Jeune.php');
        }
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Demande de Reference</title>
        <link rel="icon" href="LOGO/LOGO 1.png">
        <link rel="stylesheet" href="Demande_De_Reference.css">
        <script src="demande_de_reference.js"></script>
    </head>
    <body>
        <div class="titre">
            <a href="Visiteurs.php"><img src="LOGO/LOGO 1.png" class="logo"></a>
            <div class="texte">JEUNE</div>
            <div class="soustexte">Je donne de la valeur à mon engagement</div>
        </div>
        <div class="boutons">
            <button class="jeune">JEUNE</button>
            <form action="Referent.php">
                <button class="referent">REFERENT</button>
            </form>
            <button class="consultant">CONSULTANT</button>
            <form action="Partenaires.php">
                <button class="partenaires">PARTENAIRES</button>
            </form>
        </div>
        <div class="main">
            <div class="page">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="reference">
                        <u>DEMANDE DE REFERENCE</u> : <BR><br>
                        <div class="form-group">
                            <label for="nom">NOM :</label>
                            <input type="text" name="nom" required><br>
                        </div>
                        <div class="form-group">
                            <label for="prenom">PRÉNOM :</label>
                            <input type="text" name="prenom" required><br>
                        </div>
                        <div class="form-group">
                            <label for="date_naissance">DATE DE NAISSANCE:</label>
                            <input type="date" name="date_naissance" required><br>
                        </div>
                        <div class="form-group">
                            <label for="phone">PORTABLE :</label>
                            <input type="text" name="phone" required><br>
                        </div>
                        <div class="form-group">
                            <label for="mail">EMAIL :</label>
                            <input type="email" name="mail" required><br>
                        </div>
                        <div class="form-group">
                            <label for="social">RÉSEAU SOCIAL :</label>
                            <input type="text" name="social"><br>
                        </div>
                        <div class="form-group">
                            <label for="presentation">PRÉSENTATION :</label>
                            <input type="text" name="presentation"><br>
                        </div>
                        <div class="form-group">
                            <label for="milieu">MILIEU DE L'ENGAGEMENT :</label>
                            <input type="text" name="milieu"><br>
                        </div>
                        <div class="form-group">
                            <label for="duree">DURÉE :</label>
                            <input type="text" name="duree"><br>
                        </div>
                        <div class="text_haut_cadre">MES SAVOIRS ETRES</div>
                        <div class="cadre">
                            <div class="cadre_head">Je suis*</div>
                            <div class="cadre_body">
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Autonome" onclick="limitSelections(this)">
                                <label for="checkbox1">Autonome</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Capable d'analyse et de synthese" onclick="limitSelections(this)">
                                <label for="checkbox2">Capable d'analyse et de synthese </label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="A l'ecoute" onclick="limitSelections(this)">
                                <label for="checkbox3">A l'ecoute</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Organise" onclick="limitSelections(this)">
                                <label for="checkbox1">Organise</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Passionne" onclick="limitSelections(this)">
                                <label for="checkbox1">Passionne</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Fiable" onclick="limitSelections(this)">
                                <label for="checkbox1">Fiable</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Patient" onclick="limitSelections(this)">
                                <label for="checkbox1">Patient</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Reflechi" onclick="limitSelections(this)">
                                <label for="checkbox1">Reflechi</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Responsable" onclick="limitSelections(this)">
                                <label for="checkbox1">Responsable</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Sociable" onclick="limitSelections(this)">
                                <label for="checkbox1">Sociable</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox[]" value="Optimiste" onclick="limitSelections(this)">
                                <label for="checkbox1">Optimiste</label>
                            </div>
                            <div class="text_bas_cadre"> *Faire 4 choix maximum</div>
                        </div>
                    </div>
</div>
                    <input type="submit" value="Envoyer au Referent" class="soumettre">
                </form>
            </div>
            <div class="back">
                <img src="LOGO/logorose.png" class="bg">
            </div>
        </div>
    </body>
</html>

