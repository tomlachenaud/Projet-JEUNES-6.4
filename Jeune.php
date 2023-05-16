<?php
// Lire le contenu du fichier texte
session_start();
$filename = $_SESSION['filename'];
$email = $_SESSION['email'];
$file = fopen($email.'/'.$filename, 'r');
if ($file) {
    $line1 = fgets($file);
    $line2 = fgets($file);
    $date = fgets($file);
    $line3 = date("Y-m-d", strtotime($date));
    $line4 = fgets($file);
    $line5 = fgets($file);
    $line6 = fgets($file);
    $line7 = fgets($file);
    $line8 = fgets($file);

    fclose($file);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs soumises par le formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $dateNaissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $social = $_POST["social"];
    $engagement = $_POST["engagement"];
    $duree = $_POST["duree"];
    
    // Validation des champs
    if (empty($nom) || empty($prenom) || empty($dateNaissance) || empty($email) || empty($password)) {
        echo "Veuillez remplir tous les champs obligatoires.";
    } else {
        // Création du nom de fichier basé sur l'adresse e-mail
        $filename = $email . ".txt";
        
        // Création du contenu à écrire dans le fichier
        $contenu =  $nom . "\n";
        $contenu .= $prenom . "\n";
        $contenu .=  $dateNaissance . "\n";
        $contenu .=  $email . "\n";
        $contenu .=  $password . "\n";
        $contenu .=  $social . "\n";
        $contenu .=  $engagement . "\n";
        $contenu .=  $duree . "\n";
        
        // Vérifier si un fichier PDF a été téléchargé
        if (isset($_FILES["pdfFile"]) && $_FILES["pdfFile"]["error"] === UPLOAD_ERR_OK) {
            $pdfFileName = $_FILES["pdfFile"]["name"];
            $pdfFileTmp = $_FILES["pdfFile"]["tmp_name"];
            $pdfFilePath = $email . '/' . $pdfFileName;
            
            // Supprimer les autres fichiers PDF dans le dossier
            $files = scandir($email);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf' && $file !== $pdfFileName) {
                    unlink($email . '/' . $file);
                }
            }

            // Déplacer le fichier PDF vers l'emplacement souhaité
            move_uploaded_file($pdfFileTmp, $pdfFilePath);
            
            // Enregistrer le nom du fichier PDF dans le fichier texte
            $contenu .= "FICHIER PDF: " . $pdfFileName . "\n";
        }

        // Écriture du contenu dans le fichier texte
        file_put_contents($filename, $contenu);

        header("Location: Jeune.php");
        exit();
    }
}
?>





<!DOCTYPE html>
<html>
    <head>
        <title>Jeune</title>
        <link rel="icon" href="LOGO/LOGO 1.png">
        <link rel="stylesheet" href="Jeunes.css">
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
            <div class=modification>
            <u>PROFILE</u> : <BR></BR>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
        <label for="nom">NOM :</label>
        <input type="text" name="nom" required class="nom" value="<?php echo htmlentities($line1); ?>"><br>
        </div>

        <div class="form-group">
        <label for="prenom">PRÉNOM :</label>
        <input type="text" name="prenom" required class="prenom" value="<?php echo htmlentities($line2); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="date_naissance">DATE DE NAISSANCE :</label>
        <input type="date" name="date_naissance" required class="date" value="<?php echo htmlentities($line3); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="email">EMAIL :</label>
        <input type="email" name="email" required class="email" value="<?php echo htmlentities($line4); ?>"><br>
        </div>
        
        <div class="group">
        <label for="password" class="lgroup">MOT DE PASSE :</label>
        <input type="password" name="password" id="passwordInput" required value="<?php echo htmlentities($line5); ?>" class="igroup">
        <input type="button" id="showPasswordCheckbox" class="affichage" value="&#850">
        <script src="Jeune.js"></script>
        </div>

        <div class="form-group">
        <label for="social">RÉSEAU SOCIAL :</label>
        <input type="text" name="social" class="social" value="<?php echo htmlentities($line6); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="engagement">MON ENGAGEMENT :</label>
        <input type="text" name="engagement"class="engagement" value="<?php echo htmlentities($line7); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="duree">DURÉE :</label>
        <input type="text" name="duree" class="duree" value="<?php echo htmlentities($line8); ?>"><br>
        </div>

        <div class="PDF">
                <label for="pdfFile">Fichier PDF :</label>
                <input type="file" name="pdfFile" accept="application/pdf">
            </div>
            
            <?php
    $directory = $email; // Spécifiez le chemin vers le dossier contenant les fichiers PDF
$files = scandir($directory); // Récupère la liste des fichiers du dossier

$pdfFileName = '';

// Parcourir les fichiers du dossier
foreach ($files as $file) {
    // Vérifier si le fichier a une extension PDF
    if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
        $pdfFileName = $file; // Récupérer le nom du premier fichier PDF trouvé
        break; // Sortir de la boucle une fois qu'un fichier PDF est trouvé
    }
}
        $pdfFilePath = $email . '/' . $pdfFileName;
        if (file_exists($pdfFilePath)) {
            echo '<div class="pdf-link">
                <a href="' . $pdfFilePath . '" target="_blank" class="lien">Voir le PDF</a>
            </div>';
        }
        ?>
        <input type="submit" value="Enregistrer" class="soumettre">

    </form>

    
</div>
<br><br><br>
<div class="modification">
<u>REFERENCE :</u> 

<form action="Demande_de_Reference.php">
    <br>
    <button class="soumettre">Demande de Reference</button>
</form>

</div>
<div class="back">
        <img src="LOGO/logorose.png" class="bg">

</div>
</div>

    </body>
</html>