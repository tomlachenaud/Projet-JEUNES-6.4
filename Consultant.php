<?php
session_start();
$filename = $_SESSION['filename'];
$email = $_SESSION['email'];
$filenameref = $_SESSION['filenameref'];
$emailref = $_SESSION['emailref'];
$fileref = fopen($emailref.'/'.$filenameref, 'r');
$file = fopen($email.'/'.$filename, 'r');
    if ($file) {
    $line1 = fgets($file);
    $line2 = fgets($file);
    $date = fgets($file);
    $line3 = date("Y-m-d", strtotime($date));
    $line4 = fgets($file);
    $line5 = fgets($file);
    $line6 = fgets($file);

    fclose($file);
}

if ($fileref) {
    $line1ref = fgets($fileref);
    $line2ref = fgets($fileref);
    $dateref = fgets($fileref);
    $line3ref = date("Y-m-d", strtotime($dateref));
    $line4ref = fgets($fileref);
    $line5ref = fgets($fileref);
    $line6ref = fgets($fileref);
    $line7ref = fgets($fileref);
    $line8ref = fgets($fileref);
    $line9ref = fgets($fileref);

}
fclose($fileref);

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Consultant</title>
        <link rel="stylesheet" href="Consultant.css">
    </head>
    <body>
    <div class="titre">
        <a href="Visiteurs.php"><img src="LOGO/LOGO 1.png" class="logo"></a>
        <div class="texte">CONSULTANT</div>
        <div class="soustexte">Je donne de la valeur à ton engagement</div>
    </div>

    <div class="boutons">
        <button class="jeune">JEUNE</button>
        <button class="referent">REFERENT</button>
        <button class="consultant">CONSULTANT</button>
        <form action="Partenaires.php">
            <button class="partenaires">PARTENAIRES</button>
        </form>
    </div>
    <div class="page">
        <div class="main1">
        <div class="textehaut">Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</div><br><br><br>

            <div class=modification>
                <u>JEUNE</u> : <BR></BR>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="form-group1">
                        <label for="nom">NOM :</label>
                        <input type="text" name="nom" required class="nom" value="<?php echo htmlentities($line1); ?>" readonly ><br>
                    </div>

                    <div class="form-group1">
                        <label for="prenom">PRÉNOM :</label>
                        <input type="text" name="prenom" required class="prenom" value="<?php echo htmlentities($line2); ?>" readonly><br>
                    </div>

                    <div class="form-group1">
                        <label for="date_naissance">DATE DE NAISSANCE :</label>
                        <input type="date" name="date_naissance" required class="date" value="<?php echo htmlentities($line3); ?>"readonly><br>
                    </div>

                    <div class="form-group1">
                        <label for="email">EMAIL :</label>
                        <input type="email" name="email" required class="email" value="<?php echo htmlentities($line4); ?>"readonly><br>
                    </div>

                    <div class="form-group1">
                        <label for="social">RÉSEAU SOCIAL :</label>
                        <input type="text" name="social" class="social" value="<?php echo htmlentities($line6); ?>"readonly><br>
                    </div>
                    <div class="check_pink">
                        <div class="pink_head"> <div class="pink_text"> Je suis </div></div>
                        <div class="pink_body">
                    <?php
    $checkboxes = $_SESSION['checkboxes'];
    // Affichage des cases cochées
    foreach ($checkboxes as $checkbox) {
            echo '<div class="checkbox-coche">';
            echo '<input type="checkbox" checked disabled>';
            echo $checkbox;
            echo '</div>';
    }
?>

</div>
</div>
                </form>
            </div>
        </div>

        <div class="main2">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="reference">
                <u>REFERENT</u> : <BR></BR>

                    <div class="form-group2">
                        <label for="nom_ref">NOM :</label>
                        <input type="text" name="nom_ref" required value="<?php echo htmlentities($line1ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="prenom_ref">PRÉNOM :</label>
                        <input type="text" name="prenom_ref" required value="<?php echo htmlentities($line2ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="date_naissance_ref">DATE DE NAISSANCE:</label>
                        <input type="date" name="date_naissance_ref" required value="<?php echo htmlentities($line3ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="phone_ref">PORTABLE :</label>
                        <input type="text" name="phone_ref" required value="<?php echo htmlentities($line4ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="mail_ref">EMAIL :</label>
                        <input type="email" name="mail_ref" required value="<?php echo htmlentities($line5ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="social_ref">RÉSEAU SOCIAL :</label>
                        <input type="text" name="social_ref" value="<?php echo htmlentities($line6ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="presentation_ref">PRÉSENTATION :</label>
                        <input type="text" name="presentation_ref" value="<?php echo htmlentities($line7ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="milieu">MILIEU DE L'ENGAGEMENT :</label>
                        <input type="text" name="milieu_ref" value="<?php echo htmlentities($line8ref); ?>"readonly><br>
                    </div>
                    <div class="form-group2">
                        <label for="duree_ref">DURÉE :</label>
                        <input type="text" name="duree_ref" value="<?php echo htmlentities($line9ref); ?>"readonly><br>
                    </div>
                    <div class="commentaire">
                        <label for="commentaire">COMMENTAIRE</label>
                        <?php
$filename = $_SESSION['emailref'].'/'.$_SESSION['filenameref']; 
$searchString = 'Commentaires : ';

// Vérifie si le fichier existe
if (file_exists($filename)) {
    // Ouvre le fichier en lecture
    $file = fopen($filename, 'r');

    // Vérifie si l'ouverture du fichier a réussi
    if ($file) {
        $found = false; // Indicateur pour marquer si la chaîne de caractères a été trouvée
        $result = ''; // Variable pour stocker le texte après la chaîne de caractères

        // Parcourt le fichier ligne par ligne jusqu'à la fin ou jusqu'à ce que la chaîne de caractères soit trouvée
        while (($line = fgets($file)) !== false && !$found) {
            if (strpos($line, $searchString) !== false) {
                $found = true; // La chaîne de caractères a été trouvée
                echo 'oui';
            }
        }

        // Si la chaîne de caractères a été trouvée, récupère le texte après la chaîne de caractères
        if ($found) {
            $lines = array(); // Tableau pour stocker les lignes du fichier
            $mergedText=rtrim($line, "\r\n");
            // Parcourt le fichier ligne par ligne jusqu'à la fin
            while (($line = fgets($file)) !== false) {
                $lines[] = $line; // Ajoute chaque ligne au tableau
                $line = rtrim($line, "\r\n"); // Supprime les retours à la ligne de la ligne
                $mergedText .= $line;
            }
        }
    }

    // Ferme le fichier
    fclose($file);


}
?>
                        <textarea name="commentaire" class="commentaire_text"><?php echo $mergedText; ?></textarea>
                    </div>
                    <div class="check_green">
                        <div class="green_head">
                        <div class="green_text">Je confirme</div>
</div>
<div class="green_body">
                    <?php
    $checkboxes_ref = $_SESSION['checkboxes_ref'];
    // Affichage des cases cochées

    foreach ($checkboxes_ref as $checkbox_ref) {
            echo '<div class="checkbox-coche">';
            echo '<input type="checkbox" checked disabled>';
            echo $checkbox_ref;
            echo '</div>';
    }
?>
</div>

                    </div>
                </div>
            </form>
        </div>

        <div class="back">
            <img src="LOGO/logobleu.png" class="bg">
        </div>
    </div>

    </body>
</html>