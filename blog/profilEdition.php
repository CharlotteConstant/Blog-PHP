<?php require_once "logique.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau post</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/solar/bootstrap.css">
</head>
<body>

<?php require_once dirname(__FILE__)."/../navbar.php" ?>

<div class="container">
<h1 class="text-center mt-4">Formulaire de modification d'article</h1>

<?php 
foreach($resultProfil as $value){ 
?>

<img src="../images/profiles/<?php echo $value['image'] ?>">
<p> Modifier photo de profil: </p>
<!-- upload photo -->
    <form action="" method="POST" enctype="multipart/form-data" >
    <input type="hidden" name="profilePic" value="upload">
    <input type="hidden" name="userId" value="<?php echo $value['id']?>">
    <input type="file" name="picToUpload">
    <button type="submit" class="btn btn-success">Envoyer</button>
    </form>

<form method="POST">   
   <input type="hidden" name="userIdAModifier" value="<?php echo $value['id'] ?>">
    <div class="form-group">
 
       <input class="form-control" type="text" value="<?php echo $value['email']; ?>" name="displayEmail" placeholder="écris ton mail ici...">
    </div>
    <div class="form-group">
        
        <input class="form-control" type="text" value="<?php echo $value['displayName']; ?>" name="displayNameProfil" placeholder="écris ton display name ici...">
    </div>
    <div>
        <input type="submit" name="id" class="btn btn-secondary mt-3" value="enregistrer les modifications">
    </div>
</form>


 <?php } ?>






</div>


</body>
</html>