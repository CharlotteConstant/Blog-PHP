<?php 

require_once "logique.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
     <link rel="stylesheet" href="https://bootswatch.com/5/solar/bootstrap.css">
</head>
<body>
<?php require_once dirname(__FILE__)."/../navbar.php" ?>
    
<?php if($isAdmin){ ?>

<p>Bienvenue admin</p>


<table>
<thead>
<tr>
    <th scope="col">titre</th>
    <th scope="col">auteur</th>
    <th scope="col">supprimer</th>
    <th scope="col">Publier ou Depublier</th>
    <th scope="col">Lien article</th>

</thead>
<tbody>
<?php foreach($posts as $value){ ?>

   <td><?php echo $value['title'] ?></td>
   <td><?php echo $value['username'] ?></td>

   <td>
   <form action="" method="post">
    <div class="form-group">
        <button type="submit" class="btn btn-warning" name="adminPostDel" value="<?php echo $value['id']?>">Delete</button>
   </div>
   </form>
   </td>

    <td>
     <form action="" method="post">
        <div class="form-group">
        <?php if($value['published']){ ?>

        <button type="submit" class="btn btn-info" name="adminPostUnpublish" value="<?php echo $value['id']?>">Depublier</button>
        <?php } else { ?>


        <button type="submit" class="btn btn-primary" name="adminPostPublish" value="<?php echo $value['id']?>">Publier</button>
        <?php } ?>
        </div>
     </form>
    </td>
   
    <td>
        <a class="btn btn-primary" href="postUnique.php?postId=<?php echo $value['id'] ?>">voir article</a>
    </td>
   
</tr>

<?php } ?>
</tbody>
</table>



<?php }else{ ?>

<p>Vous n'êtes pas admin </p>

<?php } ?>

</body>
</html>