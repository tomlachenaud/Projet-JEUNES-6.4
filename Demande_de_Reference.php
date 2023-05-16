<!DOCTYPE html>

<html>
    <head>
        <title>Demande de Reference</title>
        <link rel="icon" href="LOGO/LOGO 1.png">
        <link rel="stylesheet" href="Demande_de_Reference.css">

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
            <div class="page">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="reference">
        <u>DEMANDE DE REFERENCE</u> : <BR></BR>
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
        <input type="text" name="social" ><br>
        </div>
        <div class="form-group">
        <label for="presentation">PRÉSENTATION :</label>
        <input type="text" name="presentation" ><br>
        </div>
        <div class="form-group">
        <label for="milieu">MILIEU DE L'ENGAGEMENT :</label>
        <input type="text" name="nom" ><br>
        </div>
        <div class="form-group">
        <label for="duree">DURÉE :</label>
        <input type="text" name="duree" ><br>
        </div>
</div>
        <div>
        <div>Je suis*</div>
        <?php
        $elements = array(
            "Autonome",
            "Passionné",
            "Réfléchi",
            "A l'écoute",
            "Organisé",
            "Passionné",
            "Fiable",
            "Patient",
            "Réfléchi",
            "Responsable",
            "Sociable",
            "Optimiste",
        );

        foreach ($elements as $element) {
            echo '<input type="checkbox" name="elements[]" value="' . $element . '"> ' . $element . '<br>';
        }
        ?>
        </div>

        <input type="submit" value="Valider">
        </form>
        <input type="submit" value="Envoyer au Referent" class="soumettre">
        </form>
</div>
        <div class="back">
        <img src="LOGO/logorose.png" class="bg">
</div>
</div>
    </body>
</html>
