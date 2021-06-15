<?php

$_POST;

if(isset($_POST['usernameSignUp']) && isset($_POST['passwordSignUp']) && isset($_POST['passwordReTypeSignUp']) && isset($_POST['emailSignUp']) && isset($_POST['displayNameSignUp']) && isset($_POST['roleSignUp']) ){
    if( !empty($_POST['usernameSignUp']) && !empty($_POST['passwordSignUp']) && !empty($_POST['passwordReTypeSignUp']) && !empty($_POST['emailSignUp']) && !empty($_POST['displayNameSignUp']) && !empty($_POST['roleSignUp']) ){
 
            echo "tout est plein";

            $usernameSignUp = $_POST['usernameSignUp'];
            $passwordSignUp = $_POST['passwordSignUp'];
            $passwordReTypeSignUp = $_POST['passwordReTypeSignUp'];
            $emailSignUp = $_POST['emailSignUp'];
            $displayNameSignUp = $_POST['displayNameSignUp'];
            $roleSignUp = $_POST['roleSignUp'];

            // verif mot de passe pareil
            if($passwordSignUp == $passwordReTypeSignUp){
                
                require_once dirname(__FILE__)."/../access/db.php";

                //check le username libre
                $usernameFiltre = mysqli_real_escape_string($maConnexion, $usernameSignUp);
                $maRequeteCheckSiUsernameLibre = "SELECT * FROM users WHERE username= '$usernameFiltre'";
                $retourRequeteCheckUsername = mysqli_query($maConnexion, $maRequeteCheckSiUsernameLibre);
                
                if($retourRequeteCheckUsername -> num_rows == 0){
                    echo "on peut l'inscrire";
                    //cryptage mdp et salt
                    $motCrypte = md5($passwordSignUp);
                    require_once dirname(__FILE__)."/../access/salt.php";
                    $motDePasseCrypteEtSelCrypte = $motCrypte.md5($salt);
                    
                    $maRequeteInscription = "INSERT INTO users (username, password, email, displayName, image) VALUES ('$usernameSignUp', '$motDePasseCrypteEtSelCrypte','$emailSignUp','$displayNameSignUp', 'defaut.png')";
                    $resultatInscription = mysqli_query($maConnexion, $maRequeteInscription);

                    if($resultatInscription){
                        //$modeInscription = false;
                        header('Location: index.php?info=registered');
                    }else{
                        die(mysqli_error($maConnexion));
                    }
                
                }else{
                    echo "username non dispo";
                }


            }else{
                echo "les deux mots de passe ne correspondent pas";
            }
            
      
    }else{
        echo "il manque des trucs dans le formulaire";
    }

}else {
    echo "il manque des trucs";
}

?>