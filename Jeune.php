
<?php
// Lire le contenu du fichier texte
session_start();
$filename=$_SESSION['filename'];
$email=$_SESSION['email'];
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
        <a href="Home.php"><img src="LOGO/LOGO 1.png" class="logo"></a>
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

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required class="nom" value="<?php echo htmlentities($line1); ?>"><br>
        </div>

        <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required class="prenom" value="<?php echo htmlentities($line2); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="date_naissance" required class="date" value="<?php echo htmlentities($line3); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" required class="email" value="<?php echo htmlentities($line4); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="password">Mot de Passe :</label>
        <input type="password" name="password" id="passwordInput" required value="<?php echo htmlentities($line5); ?>">
        <input type="button" id="showPasswordCheckbox"> Afficher le mot de passe
        <script src="Jeune.js"></script>
        </div>

        <div class="form-group">
        <label for="social">Reseau Social :</label>
        <input type="text" name="social" class="social" value="<?php echo htmlentities($line6); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="engagement">MON ENGAGEMENT :</label>
        <input type="text" name="engagement"class="engagement" value="<?php echo htmlentities($line7); ?>"><br>
        </div>
        
        <div class="form-group">
        <label for="duree">DUREE :</label>
        <input type="text" name="duree" class="duree" value="<?php echo htmlentities($line8); ?>"><br>
        </div>
        <input type="submit" value="Enregistrer">
    </form>
    </body>
</html>