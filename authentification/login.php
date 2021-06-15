<?php

if(isset($_POST['username']) && $_POST['username'] !== ""){
    
    if(isset($_POST['password']) && $_POST['password'] !== ""){
        
        $username = $_POST['username'];
        $password = $_POST["password"];
        require_once dirname(__FILE__)."/../access/db.php";
        $usernameFiltre = mysqli_real_escape_string($maConnexion, $username);
           
           
            //mysqli_real_escape_string


           $maRequete = "SELECT * FROM users WHERE username = '$usernameFiltre'";
           $leResultatDeMaRequeteUsername = mysqli_query($maConnexion, $maRequete);
        
            
            if($leResultatDeMaRequeteUsername -> num_rows == 1){
        
                foreach($leResultatDeMaRequeteUsername as $value){
                  $vraiMDP = $value['password'];
                  $userId = $value['id'];
                  $displayName = $value['displayName'];
                  $userName = $value['username'];
                  $role = $value['role'];
                }
                require_once dirname(__FILE__)."/../access/salt.php";
                    if (md5($password).md5($salt) == $vraiMDP){
                        $_SESSION['userId'] = $userId;
                        $_SESSION['username'] = $userName;
                        $_SESSION['displayName'] = $displayName;
                        

                        echo "bravo $username";
                        echo "bravo ".$_SESSION['userId'];
                        $isLoggedIn = true;
                        if($role == 'admin'){

                            $isAdmin = true;
                            $_SESSION['role'] = 'admin';
                        }
                       
                        
                        
                        
                       
                    }else{
                        echo "mauvais mot de passe";
                    }
            }else {
            echo "username inexistant dans la BD";
            }

        }else{
        echo "y'a pas de mot de passe";
    }

}else{
    echo "veuillez entrer un nom d'utilisateur";
}

?>