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
<h1 class="text-center mt-4">Formulaire de modification d'article</h1>

<?php 
foreach($leResultatDeMaRequeteArticleUnique as $valueUnique){ 
?>

<img src="../images/posts/<?php echo $valueUnique['image']?>" alt="" srcset="">
<p>modifier la photo :</p>
            <form action="" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="postPic" value="upload">

                    <input type="hidden" name="postId" value="<?php echo $valueUnique['id'] ?>">
                    <input type="hidden" name="authorId" value="<?php echo $valueUnique['authorId'] ?>">

                    <input type="file" name="postPictureToUpload">
                    <button type="submit" class="btn btn-primary">Envoyer la photo</button>
            </form>

<form method="POST">   
    <div class="form-group">
        <label class="form-label" for="readOnlyInput">Titre</label>
        <input class="form-control" id="readOnlyInput" type="text" value="<?php echo $valueUnique['title']; ?>" name="modifierTitre" placeholder="écris ton titre ici...">
    </div>
    <div class="form-group">
      <label for="exampleTextarea">Article</label>
      <textarea class="form-control" id="exampleTextarea" name="modifierTexte" placeholder="redige ton article..." rows="3"><?php echo $valueUnique['content']; ?></textarea>
    </div>
    <div>
        <button type="submit" name="id" value="<?php echo $valueUnique['id'] ?>" class="btn btn-secondary mt-3">Enregistrer les modifications</button>
    </div>
</form>

<form>
    <div>
<button type="submit" name="delete" value="<?php echo $valueUnique['id'] ?>" class="btn btn-warning mt-3">Supprimer</button>

</div>
</form>

 <?php } ?>
</div>

</body>
</html>