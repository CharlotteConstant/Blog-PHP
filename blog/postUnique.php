<?php include "logique.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/solar/bootstrap.css">
</head>
<body>

<?php require_once dirname(__FILE__)."/../navbar.php" ?>


<div class="container">
    <h1 class="text-center"> Bienvenue sur l'article complet </h1>
    

    <?php 

    foreach($leResultatDeMaRequeteArticleUnique as $valueUnique){?>
    <div>
        <img src="../images/posts/<?php echo $valueUnique['image']?>" alt="">
    </div>
    <?php
    echo $valueUnique['title'];
    echo "<br>";
    echo $valueUnique['content'];
    ?>

</div>

<?php if($isLoggedIn && $isOwner){?>
<div class="row">
<form action="edition.php" method="POST">
    <button type="submit" name="postId" value="<?php echo $valueUnique['id']?>" class="btn btn-primary">modifier un article</button>
</form>

<form action="" method="POST">
<input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
<?php if($valueUnique['published']){ ?>

<button type="submit" name="unpublish" value="<?php echo $valueUnique['id']?>" class="btn btn-danger">Dépublier</button>
    

<?php }else{ ?>
<button type="submit" name="publish" value="<?php echo $valueUnique['id']?>" class="btn btn-success">Publier l'article</button>

<?php } ?>

</form>

</div>

<?php } ?>
<?php
}

?>

<div class="row">

<a href="/testphp/blogCopy" class="btn btn-warning">Retour accueil</a>
</div>


    <?php if($isLoggedIn){ ?>
    <div class="row mt-5">
        <form action="" method="POST">
        <div class="form-group">
        <input type="text" name="comment" class="form-control" placeholder="votre commentaire">
        <input type="hidden" name="postToComment" value="<?php echo $postId ?>">
         <input type="hidden" name="commentAuthor" value="<?php echo $_SESSION['userId'] ?>">
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-success">Poster le commentaire</button>
        </div>
        </form>
    </div>
  <?php } ?>


<hr>

<?php foreach($mesCommentaires as $comment){ ?>
    <div class="row">
        <p> <strong><?php if($comment['displayName'] != ""){echo $comment['displayName'];}else{echo $comment['username']; }  ?></strong> </p>
        <p> <?php echo $comment['content']; ?> </p>
    </div>
    <hr>

<?php } ?>


</body>
</html>