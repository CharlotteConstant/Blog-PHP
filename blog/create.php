<?php require "logique.php" ?>

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
<h1 class="text-center mt-4">Formulaire d'ajout d'article</h1>
<!--
  <form action="logique.php" method="POST">
                    
            <input class="form-control" type="text" name="nouveauTitre" id="" placeholder="votre titre">
            <textarea class="form-control" name="nouveauTexte" id="" cols="30" rows="10" placeholder="votre texte"></textarea>
            <input class="form-control btn btn-success" type="submit" value="Envoyer">
                        
                    
                    
  </form>
-->

<form action= "logique.php" method="POST" enctype="multipart/form-data">   
  <input type="file" name="uploadPostPic">
    <div class="form-group">
        <label class="form-label" for="readOnlyInput">Titre</label>
        <input class="form-control" id="readOnlyInput" type="text" name="nouveauTitre" placeholder="écris ton titre ici...">
    </div>
    <div class="form-group">
      <label for="exampleTextarea">Article</label>
      <textarea class="form-control" id="exampleTextarea" name="nouveauTexte" placeholder="redige ton article..." rows="3"></textarea>
    </div>
  
    <div class="form-group">
      <input type="hidden" class="form-control" id="authorId" name="authorId" rows="3">
    </div>

    <div>
        <button type="submit" class="btn btn-secondary mt-3">Envoyer</button>
    </div>


</form>



</div>
 
</body>
</html>
