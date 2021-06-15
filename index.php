<?php 

require_once "blog/logique.php";

?>

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
<?php require_once "navbar.php" ?>

<?php if(isset($_GET['info']) && $_GET['info']== "registered"){ ?>

<div class="alert alert-success" role="alert">
Successfully registered !
</div>
<?php }?>

<?php if( isset($_GET['info']) && $_GET['info'] == 'added' ){?>

<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> You successfully posted <a href="#" class="alert-link">a new article</a>.
</div>
<?php } ?>

<?php if( isset($_GET['info']) && $_GET['info'] == 'deleted' ){?>

<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> You successfully deleted <a href="#" class="alert-link">this article</a>.
</div>
<?php } ?>

<?php if( isset($_GET['info']) && $_GET['info'] == 'pasLeDroit' ){?>

<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Non vous avez pas le droit de faire ca!</strong> <a href="#" class="alert-link">this article</a>.
</div>
<?php } ?>

<?php if( isset($_GET['info']) && $_GET['info'] == 'default' ){?>

<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> You successfully posted but no picture<a href="#" class="alert-link">a new article</a>.
</div>
<?php } ?>

<?php if( isset($_GET['info']) && $_GET['info'] == 'extension' ){?>

<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> You successfully posted but picture mauvaise extension<a href="#" class="alert-link">a new article</a>.
</div>
<?php } ?>

<?php if( isset($_GET['info']) && $_GET['info'] == 'oversized' ){?>

<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> You successfully posted but picture mauvais oversized<a href="#" class="alert-link">a new article</a>.
</div>
<?php } ?>

<?php if( isset($_GET['info']) && $_GET['info'] == 'resolution' ){?>

<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> You successfully posted but picture mauvaise resolution<a href="#" class="alert-link">a new article</a>.
</div>
<?php } ?>

<div class="container">

<!-- Formulaire inscription -->
 <?php if($modeInscription){?>

        <form action="" method="POST">

            <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="usernameSignUp">
            </div>

            <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="passwordSignUp">
            </div>

            <div class="form-group">
            <label for="passwordReType">re type-Password</label>
            <input type="password" class="form-control" name="passwordReTypeSignUp">
            </div>

            <div class="form-group">
            <label for="mail">Email</label>
            <input type="email" class="form-control" name="emailSignUp">
            </div>

            <div class="form-group">
            <label for="displayName">display Name</label>
            <input type="text" class="form-control" name="displayNameSignUp">
            </div>

             <div class="form-group">
            <label for="role">role</label>
            <input type="text" class="form-control" name="roleSignUp">
            </div>

            <div class="form-group">
            <input type="hidden" name="info" value="on">
            <input type="submit" value="s'inscrire" class="btn btn-success">
            </div>
        </form>
         <form method="POST">
        <button type="submit" class="btn btn-primary" name="info" value="off">Se connecter</button>
        </form>
<hr>
    <?php }else{ ?>

<div class="row">    
        <?php
        foreach($leResultatRequete as $value){       
        ?>

        <div class="col-4">
            <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
                <img src="images/posts/<?php echo $value['image']?>" alt="">

                <div class='card-header'><?php echo $value['title']; ?></div>
                      <div class='card-body'>
                      <?php if(isset($value['published'])){
                                  if($value['published']){?>
                                 <span class="badge rounded-pill bg-success">Published</span>

                      <?php   }else{?>
                                <span class="badge rounded-pill bg-primary">non-published</span>

                      <?php } } ?>
                        <p class='card-text'><?php echo $value['content'] ?></p>
                        <p class='card-text'><a class="text-white" href="<?php echo $racineSite ?>/blog/profil.php?profile=<?php echo $value['authorId'] ?>"> Auteur: <?php if($value['displayName'] != "") {echo $value['displayName'];}else{echo $value['username'];} ?></a></p>
                    
                      </div>
                       
                        <a class ="text-white btn-success" href="blog/postUnique.php?postId=<?php echo $value['id']?>">Aller a l'article</a>
                     
            </div>   
            
        </div>


        <?php
        }
        ?>
</div>
         <?php
        }
        ?>
</div>  

    
</body>
</html>