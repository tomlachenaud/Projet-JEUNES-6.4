<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs soumises par le formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $dateNaissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $social = $_POST["social"];
    
    // Validation des champs
    if (empty($nom) || empty($prenom) || empty($dateNaissance) || empty($email) || empty($password)) {
        echo "Veuillez remplir tous les champs obligatoires.";
    } else {
        // Création du nom de fichier basé sur l'adresse e-mail
        $filename = $email . ".txt";
        $_SESSION['email'] =$email;
        $_SESSION['filename'] =$email . ".txt";
        
        // Création du contenu à écrire dans le fichier
        $contenu =  $nom . "\n";
        $contenu .= $prenom . "\n";
        $contenu .=  $dateNaissance . "\n";
        $contenu .=  $email . "\n";
        $contenu .=  $password . "\n";
        $contenu .=  $social . "\n";
        mkdir($email);
        file_put_contents($email.'/'.$filename, $contenu);

        header("Location: Jeune.php");
        exit();
    
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="LOGO/LOGO 1.png">
        <title >Inscription Jeune</title>
        <link rel="stylesheet" href="inscriptionjeune.css">


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
        <div class="textehaut">Decrivez votre experience et mettez en avant ce que vous en avez retire.</div><br><br><br>
        <div class="inscription">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required class="nom"><br>
        </div>

        <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required class="prenom"><br>
        </div>
        
        <div class="form-group">
        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="date_naissance" required class="date"><br>
        </div>
        
        <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" required class="email"><br>
        </div>
        
        <div class="form-group">
        <label for="password">Mot de Passe :</label>
        <input type="password" name="password" required>
        </div>

        <div class="form-group">
        <label for="social">Reseau Social :</label>
        <input type="text" name="social" class="social"><br>
        </div>
    
        <input type="submit" value="S'inscrire" class="soumettre">
        
    </form>
    <div class="connexion">Deja un compte ?
        <a href="Connexionjeune.php" class="connect">Connectez-vous !</a>
    </div>

</div>
<div class="back">
        <img src="LOGO/logorose.png" class="bg">
</div>
        </div>
    </body>
</html>

