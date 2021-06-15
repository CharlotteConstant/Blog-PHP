<?php

require_once "logique.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page profil</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/solar/bootstrap.css">
</head>
<body>
    <?php require_once dirname(__FILE__)."/../navbar.php" ?>

    <?php if(isset($_GET['info']) && $_GET['info'] == "resolution"){ ?>
    <div class="alert alert-danger" role="alert">
    <p> Mauvaise résolution </p>
    </div>

    <?php } ?>

    <div class="container">
    <h2 class="text-center mb-5 text-white mt-3"> -- Page du profil -- </h2>

    <?php foreach($resultProfil as $value) { ?>
        <h3 class="text-center border text-white">Bienvenue sur le profil de <?php echo $value['username'] ?></h3>
        <img src="../images/profiles/<?php echo $value['image'] ?>">

        
        <h3 class="mt-4"><u>Information du profil: </u> </h3>
        <h4>Email: <?php echo $value['email'] ?></h4>
        <h4>Display name: <?php echo $value['displayName'] ?></h4>
       
        <?php if($isLoggedIn && $isUser){?>
        <div class="row">
        <form action="profilEdition.php" method="POST">
        <button type="submit" name="profilEdit" value="<?php echo $_SESSION['userId']?>" class="btn btn-primary">modifier mon profil</button>
        </form>
        </div>
        <?php } ?>


    <?php } ?>

    
    
    </div>
</body>
</html>