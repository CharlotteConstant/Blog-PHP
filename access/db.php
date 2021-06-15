
<?php

$monHote = "localhost";
$database= "blog";
$databaseUser = "carlota";
$userPassword = "0605";
//tester la connexion à la base de données
    $maConnexion = mysqli_connect($monHote, $databaseUser, $userPassword, $database);
    if(!$maConnexion){
        echo "
    <div class='alert alert-dismissible alert-warning'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        <h4 class='alert-heading'>Warning!</h4>
        <p class='mb-0'>Problème de connexion à la base de données.</p>
    </div>";
        die();
    }

?>