<?php
    $checkboxes = $_SESSION['checkboxes'];
    // Affichage des valeurs des cases cochées
    echo "Cases cochées : ";
    foreach ($checkboxes as $checkbox) {
        echo $checkbox . ", ";
    }
?>