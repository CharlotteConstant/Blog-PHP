<?php

$modeInscription = false;

$isLoggedIn = false;
$isAdmin = false;

if(isset($_SESSION['userId'])){
    $isLoggedIn = true;
}

if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
    $isAdmin = true;
}


if($isLoggedIn){

    echo "LOGGED IN";

}else{
    require_once "login.php";

}
if(isset($_POST['info']) && $_POST['info']== "on"){

    $modeInscription = true;
    require_once "signup.php";
}
if(isset($_POST['modeInscription']) && $_POST['modeInscription']== "off"){

    $modeInscription = false;
}


if($modeInscription){
    require_once "signup.php";
}

?>