<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Récupération de l'e-mail soumis par le formulaire
    $email = $_POST["email"];

    // Création du nom de fichier basé sur l'adresse e-mail
    $_SESSION['email'] =$email;
    $_SESSION['filename'] =$email . ".txt";
    $filename = $email . ".txt";

  // Récupérer les données saisies dans la page web
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Lire le contenu du fichier texte
  $content = file_get_contents($email.'/'.$filename);

  // Vérifier si le texte est présent dans le contenu du fichier texte
  if (strpos($content, $email) !== false && strpos($content, $password) !== false) {
    header("Location: Jeune.php");
        exit();
  } else {
    echo 'Identifiants invalides';

  }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="LOGO/LOGO 1.png">
        <title>Connexion Jeune</title>
        <link rel="stylesheet" href="ConnexionJeune.css">

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
        <div class="connexion">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe :</label>
            <input type="password" name="password" required>
        </div>
            
            <input type="submit" value="Connexion" class="soumettre">
        </form>
        </div>
        </div>
    </body>
</html>