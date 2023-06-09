<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['filename'] = $filename = trim($_GET['filename']);
    $_SESSION['email'] = $email = trim($_GET['email']);
    $file = fopen(trim($email) . '/' . trim($filename), 'r');
    
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
$checkJ=fopen(trim($email) . '/checkboxes.txt', 'r');
if ($checkJ){
    $lines = array();
    
        // Lire le fichier ligne par ligne jusqu'à la fin
        while (($line = fgets($checkJ)) !== false) {
                    // Supprime les espaces en début et fin de ligne
                    $line = trim($line);
            // Vérifie si la ligne n'est pas vide
            if (!empty($line)) {
                $lines[] = $line; // Ajoute la ligne au tableau
            }
        }
        $_SESSION['checkboxes']=$lines;
        // Fermer le fichier
        fclose($checkJ);
}
}


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
    <div class="presentation">
            <h2>De quoi s'agit-il ?</h2>
            <b>D’une opportunite :</b> celle qu’un engagement quel qu’il soit puisse etre
considerer a sa juste valeur !
            <br>Toute experience est source d’enrichissement et doit d’etre reconnu largement.
            <br>Elle revele un potentiel, l’expression d’un savoir-etre a concretiser.
            <h2>A qui s'adresse-t'il ?</h2>
            <b>A vous, jeunes entre 16 et 30 ans,</b> qui vous etes investis spontanement dans une association ou dans tout type d’action formelle ou informelle, et qui avez partage de votre temps, de votre energie, pour apporter un soutien, une aide, une competence.<br>
            <br><b>A vous,responsables de structures ou referents d’un jour,</b> qui avez croise la route de ces jeunes et avez beneficie même ponctuellement de cette implication citoyenne !
            <br>C’est l’occasion de vous engager a votre tour pour ces jeunes en confirmant leur richesse pour en avoir ete un temps les temoins mais aussi les beneficiaires ! <br>
            <br> <b>A vous, employeurs, recruteurs en ressources humaines,</b> representants d’organismes de formation, qui recevez ces jeunes, pour un emploi, un stage, un cursus de qualification, pour qui le savoir-etre constitue le premier fondement de toute capacite humaine. <br>
            
        </div>
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
        <?php
        $filer = fopen($_SESSION['email'].'/referents.txt','r');
        if($filer){
            $lines = array();
    
        // Lire le fichier ligne par ligne jusqu'à la fin
        while (($line = fgets($filer)) !== false) {
                    // Supprime les espaces en début et fin de ligne
                    $line = trim($line);
            // Vérifie si la ligne n'est pas vide
            if (!empty($line)) {
                $lines[] = $line; // Ajoute la ligne au tableau
            }
        }
        // Fermer le fichier
        fclose($filer);
    
        }

        foreach ($lines as $liner) {
            $check = fopen($liner . '/' . 'checkboxesref.txt', 'r');
            if ($check) {
                // Tableau pour stocker les lignes du fichier
                $checkbox_ref = array();
        
                // Lire le fichier ligne par ligne jusqu'à la fin
                while (($line = fgets($check)) !== false) {
                    // Supprime les espaces en début et fin de ligne
                    $line = trim($line);
        
                    // Vérifie si la ligne n'est pas vide
                    if (!empty($line)) {
                        $checkbox_ref[] = $line; // Ajoute la ligne au tableau
                    }
                }
                $_SESSION['checkboxes_ref']=$checkbox_ref;
                // Fermer le fichier
                fclose($check);
            }
        
        
            $ref = fopen($liner . '/' . $liner . '.txt', 'r');
            if ($ref) {
                $line1ref = fgets($ref);
                $line2ref = fgets($ref);
                $dateref = fgets($ref);
                $line3ref = date("Y-m-d", strtotime($dateref));
                $line4ref = fgets($ref);
                $line5ref = fgets($ref);
                $line6ref = fgets($ref);
                $line7ref = fgets($ref);
                $line8ref = fgets($ref);
                $line9ref = fgets($ref);
                    $searchString = 'Commentaires : ';
                
                $found = false; // Indicateur pour marquer si la chaîne de caractères a été trouvée
                $result = ''; // Variable pour stocker le texte après la chaîne de caractères
                
                // Parcourt le fichier ligne par ligne jusqu'à la fin ou jusqu'à ce que la chaîne de caractères soit trouvée
                while (($line = fgets($ref)) !== false && !$found) {
                    if (strpos($line, $searchString) !== false) {
                        $found = true; // La chaîne de caractères a été trouvée
                    }
                }
                
                // Si la chaîne de caractères a été trouvée, récupère le texte après la chaîne de caractères
                if ($found) {
                    $lines = array(); // Tableau pour stocker les lignes du fichier
                    $mergedText = rtrim($line, "\r\n");
                    
                    // Parcourt le fichier ligne par ligne jusqu'à la fin
                    while (($line = fgets($ref)) !== false) {
                        $lines[] = $line; // Ajoute chaque ligne au tableau
                        $line = rtrim($line, "\r\n"); // Supprime les retours à la ligne de la ligne
                        $mergedText .= $line;
                    }
                }
                else{
                    $mergedText= $result;
                }
                
                fclose($ref);

            
        }
    
        ?>
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
                    
                        <textarea name="commentaire" class="commentaire_text" readonly><?php echo $mergedText; ?></textarea>
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
                <?php 
    }
    ?>
            </form>
        </div>

        <div class="back">
            <img src="LOGO/logobleu.png" class="bg">
        </div>
    </div>

    </body>
</html>