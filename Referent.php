<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['filename'] = $filename = trim($_GET['filename']);
    $_SESSION['email'] = $email = trim($_GET['email']);
    $_SESSION['filenameref'] = $filenameref = trim($_GET['filenameref']);
    $_SESSION['emailref'] = $emailref = trim($_GET['emailref']);
    $fileref = fopen($emailref.'/'.$filenameref, 'r');
    $file = fopen(trim($email) . '/' . trim($filename), 'r');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs soumises par le formulaire
    $nom = $_POST["nom_ref"];
    $prenom = $_POST["prenom_ref"];
    $dateNaissance = $_POST["date_naissance_ref"];
    $phone = $_POST["phone_ref"];
    $email = $_POST["email_ref"];
    $social = $_POST["social_ref"];
    $presentation = $_POST["presentation_ref"];
    $milieu = $_POST["milieu_ref"];
    $duree = $_POST["duree_ref"];
    $checkboxes_ref = $_POST["checkbox_ref"];
    $commentaire = "Commentaires : "."\n".$_POST["commentaire"];

    // Validation des champs
    if (empty($nom) || empty($prenom) || empty($dateNaissance) || empty($email) || empty($phone)) {
        echo "Veuillez remplir tous les champs obligatoires.";
    } else {
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

        foreach ($checkboxes_ref as $checkbox) {
            $contenu .= $checkbox . "\n";
        }

        $contenu .= $commentaire . "\n";

        // Ouvrir le fichier en mode écriture ("w")
        $fileref = fopen($_SESSION['emailref'].'/'.$_SESSION['filenameref'], 'w');

        if ($fileref) {
            // Écrire le nouveau contenu dans le fichier
            fwrite($fileref, $contenu);

            // Fermer le fichier
            fclose($fileref);

            // Redirection vers la page de validation
            header("Location: validation.php");
            exit();
        } else {
            echo "Impossible d'ouvrir le fichier en écriture.";
        }
    }
}

$file = fopen ($_SESSION['email'] . '/' . $_SESSION['filename'], 'r');
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

$fileref = fopen($_SESSION['emailref'].'/'.$_SESSION['filenameref'], 'r');
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

    fclose($fileref);
}
?>



<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="LOGO/LOGO 1.png">
    <title>Referent</title>
    <link rel="stylesheet" href="referent.css">
    <script src="Referent.js"></script>
</head>

<body>
    <div class="titre">
        <a href="Visiteurs.php"><img src="LOGO/LOGO 1.png" class="logo"></a>
        <div class="texte">REFERRENT</div>
        <div class="soustexte">Je confirme la valeur de ton engagement</div>
    </div>

    <div class="boutons">
        <button class="jeune">JEUNE</button>
        <button class="referent">REFERENT</button>
        <form action="Consultant.php">
        <button class="consultant">CONSULTANT</button>
        </form>
        <form action="Partenaires.php">
            <button class="partenaires">PARTENAIRES</button>
        </form>
    </div>

    <div class="page">
        <div class="main1">
            <div class=modification>
                <u>PROFILE</u> : <BR></BR>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="form-group1">
                        <label for="nom">NOM :</label>
                        <input type="text" name="nom" required class="nom" value="<?php echo htmlentities($line1); ?>" readonly><br>
                    </div>

                    <div class="form-group1">
                        <label for="prenom">PRÉNOM :</label>
                        <input type="text" name="prenom" required class="prenom" value="<?php echo htmlentities($line2); ?>"readonly><br>
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
                        <div class="pink_head"> 
                        <div class="pink_text"> Je suis </div>
                    </div>
                        <div class="pink_body">
                    <?php
    // Affichage des cases cochées
    $filename = $_SESSION['emailref']."/checkboxes.txt";

// Vérifier si le fichier existe
if (file_exists($filename)) {
    // Ouvrir le fichier en mode lecture
    $file = fopen($filename, "r");

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
} else {
    echo "Le fichier n'existe pas.";
}

    foreach ($lines as $checkbox) {
            echo '<div class="checkbox-coche">';
            echo '<input type="checkbox" checked disabled>';
            echo $checkbox;
            echo '</div>';
    }
?>
</div>
                </form>
            </div>
        </div>

        <div class="main2">
            <div class="textehaut">Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</div><br><br><br>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="reference">
                    <div class="form-group2">
                        <label for="nom_ref">NOM :</label>
                        <input type="text" name="nom_ref" required value="<?php echo htmlentities($line1ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="prenom_ref">PRÉNOM :</label>
                        <input type="text" name="prenom_ref" required value="<?php echo htmlentities($line2ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="date_naissance_ref">DATE DE NAISSANCE:</label>
                        <input type="date" name="date_naissance_ref" required value="<?php echo htmlentities($line3ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="phone_ref">PORTABLE :</label>
                        <input type="text" name="phone_ref" required value="<?php echo htmlentities($line4ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="email_ref">EMAIL :</label>
                        <input type="email" name="email_ref" required value="<?php echo htmlentities($line5ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="social_ref">RÉSEAU SOCIAL :</label>
                        <input type="text" name="social_ref" value="<?php echo htmlentities($line6ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="presentation_ref">PRÉSENTATION :</label>
                        <input type="text" name="presentation_ref" value="<?php echo htmlentities($line7ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="milieu">MILIEU DE L'ENGAGEMENT :</label>
                        <input type="text" name="milieu_ref" value="<?php echo htmlentities($line8ref); ?>"><br>
                    </div>
                    <div class="form-group2">
                        <label for="duree_ref">DURÉE :</label>
                        <input type="text" name="duree_ref" value="<?php echo htmlentities($line9ref); ?>"><br>
                    </div>
                        <div class="text_haut_cadre">SES SAVOIRS ETRES</div>
                        <div class="cadre">
                            <div class="cadre_head">Je confirme sa (son)*</div>
                            <div class="cadre_body">
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Ponctualité" onclick="limitSelections(this)">
                                <label for="checkbox1">Ponctualité</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Confiance" onclick="limitSelections(this)">
                                <label for="checkbox2">Confiance</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Sérieux" onclick="limitSelections(this)">
                                <label for="checkbox3">Sérieux</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Honnêteté" onclick="limitSelections(this)">
                                <label for="checkbox1">Honnêteté</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Tolérance" onclick="limitSelections(this)">
                                <label for="checkbox1">Tolérance</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Bienveillance" onclick="limitSelections(this)">
                                <label for="checkbox1">Bienveillance</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Respect" onclick="limitSelections(this)">
                                <label for="checkbox1">Respect</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Juste" onclick="limitSelections(this)">
                                <label for="checkbox1">Juste</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Impartial" onclick="limitSelections(this)">
                                <label for="checkbox1">Impartial</label>
                            </div>
                            <div class="savoir_etre">
                                <input type="checkbox" name="checkbox_ref[]" value="Travail" onclick="limitSelections(this)">
                                <label for="checkbox1">Travail</label>
                            </div>
</div>
<div class="text_bas_cadre"> *Faire 4 choix maximum</div>
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
    $mergedText="";

    // Vérifie si l'ouverture du fichier a réussi
    if ($file) {
        $found = false; // Indicateur pour marquer si la chaîne de caractères a été trouvée
        $result = ''; // Variable pour stocker le texte après la chaîne de caractères

        // Parcourt le fichier ligne par ligne jusqu'à la fin ou jusqu'à ce que la chaîne de caractères soit trouvée
        while (($line = fgets($file)) !== false && !$found) {
            if (strpos($line, $searchString) !== false) {
                $found = true; // La chaîne de caractères a été trouvée
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
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <input type="submit" value="Valider" class="soumettre"onclick="envoyerEmail()" >

            </form>
        </div>

        <div class="back">
            <img src="LOGO/logovert.png" class="bg">
        </div>
    </div>
</body>

</html>
