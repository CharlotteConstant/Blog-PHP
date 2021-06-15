<?php

session_start();

if(isset($_POST['logOut'])){
   session_unset();
} 

$isOwner = false;
$isUser = false;
$racineSite = "http://localhost/testphp/blogCopy";

require_once dirname(__FILE__)."/../access/db.php";

require_once dirname(__FILE__)."/../authentification/auth.php";

//admin delete post

if (isset($_POST['adminPostDel']) && $_POST['adminPostDel'] !="" && $isAdmin){

   $idASupprimer = $_POST['adminPostDel'];
   $requete = "DELETE FROM posts WHERE id=$idASupprimer";
   $del = mysqli_query($maConnexion, $requete);
   if(!$del){
      die(mysqli_error($maConnexion));
   }
}

//admin Unpublish

if(isset($_POST['adminPostUnpublish']) && $isAdmin){
    $postUnpublish = $_POST['adminPostUnpublish'];
    $requete = "UPDATE posts SET published = '0' WHERE id=$postUnpublish";
    $resultat = mysqli_query($maConnexion, $requete);
    header("Location: admin.php?adminPage=all");
}

//admin publish

if(isset($_POST['adminPostPublish']) && $isAdmin){
    $postPublish = $_POST['adminPostPublish'];
    $requete = "UPDATE posts SET published = '1' WHERE id=$postPublish";
    $resultat = mysqli_query($maConnexion, $requete);
    header("Location: admin.php?adminPage=all");
}

//admin recup posts


if (isset($_GET['adminPage']) && $isAdmin){
         $requete = "SELECT posts.id, posts.title, posts.published, users.displayName, users.username
         FROM posts
         INNER JOIN users
         ON users.id = posts.authorId";
         $posts = mysqli_query($maConnexion, $requete);
}


// modification image post

if(isset($_POST['postPic']) && $_POST['postPic'] == 'upload'){

    if(isset($_FILES['postPictureToUpload']['name'])){
        if($_SESSION['userId'] == $_POST['authorId']){
            $postId = $_POST['postId'];
            $extensionsAutorisees = array("jpeg", "jpg", "png");
            $hauteurMax = 108000001;
            $largeurMax = 1080000001;
            $repertoireUpload = "../images/posts/";
            $tailleMax = 300000000000000;

            $nomTemporaireFichier = $_FILES['postPictureToUpload']['tmp_name'];
      
        $mesInfos = getimagesize($_FILES['postPictureToUpload']['tmp_name']);
        

        $monTableauExtension = explode("/",$mesInfos['mime']);
        $extensionUpload = $monTableauExtension[1];
        $maLargeur = $mesInfos[0];
        $maHauteur = $mesInfos[1];
        $maTaille = $_FILES['postPictureToUpload']['size'];

        // changer nom fichier pour BDD
        $tableauTmpName = explode("\\",$nomTemporaireFichier);
        $nomFichier = end($tableauTmpName);

        $nomFinalDuFichier = $nomFichier.'.'.$extensionUpload;
        $destinationFinale = $repertoireUpload.$nomFinalDuFichier;

        //appeler methode pr deplacer le fichier depuis le cache dans la destination finale
        
        if(in_array($extensionUpload, $extensionsAutorisees)){
            if($maTaille <= $tailleMax){
                if($maLargeur <= $largeurMax && $maHauteur <= $hauteurMax){
                    if(move_uploaded_file($nomTemporaireFichier, $destinationFinale)){
                        echo "bravo fichier est envoyé";

                        $requeteUploadPhotoPosts = "UPDATE posts SET image = '$nomFinalDuFichier' WHERE id= '$postId'";
                        $resultatRequete = mysqli_query($maConnexion, $requeteUploadPhotoPosts);

                        if($resultatRequete){
                            header("location: postUnique.php?postId=$postId&info=picUploaded");
                        }else{
                            die(mysqli_error($maConnexion));
                        }
                    } else{
                    header("location: postUnique.php?postId=$postId&info=uploadFailed");
                    }
                }else{
                    header("location: postUnique.php?postId=$postId&info=resolution");
                }


            }else{
                header("location: postUnique.php?postId=$postId&info=oversized");
            }
        }else{
            header("location: postUnique.php?postId=$postId&info=extension");
        }
        

        } else {
            echo "ce n'est pas votre post";
        }

    }
}





//upload photo de profil

if(isset($_POST['profilePic']) && $_POST['profilePic'] == 'upload'){
    echo "bien dectecte envoi formulaire";

    if(isset($_FILES['picToUpload']['name'])){
        if($_SESSION['userId'] == $_POST['userId']){
            $userId = $_POST['userId'];
            $extensionsAutorisees = array("jpeg", "jpg", "png");
            $hauteurMax = 108000001;
            $largeurMax = 1080000001;
            $repertoireUpload = "../images/profiles/";
            $tailleMax = 300000000000000;

            $nomTemporaireFichier = $_FILES['picToUpload']['tmp_name'];
      
        $mesInfos = getimagesize($_FILES['picToUpload']['tmp_name']);
        

        $monTableauExtension = explode("/",$mesInfos['mime']);
        $extensionUpload = $monTableauExtension[1];
        $maLargeur = $mesInfos[0];
        $maHauteur = $mesInfos[1];
        $maTaille = $_FILES['picToUpload']['size'];

        // changer nom fichier pour BDD
        $tableauTmpName = explode("\\",$nomTemporaireFichier);
        $nomFichier = end($tableauTmpName);

        $nomFinalDuFichier = $nomFichier.'.'.$extensionUpload;
        $destinationFinale = $repertoireUpload.$nomFinalDuFichier;

        //appeler methode pr deplacer le fichier depuis le cache dans la destination finale
        
        if(in_array($extensionUpload, $extensionsAutorisees)){
            if($maTaille <= $tailleMax){
                if($maLargeur <= $largeurMax && $maHauteur <= $hauteurMax){
                    if(move_uploaded_file($nomTemporaireFichier, $destinationFinale)){
                        echo "bravo fichier est envoyé";

                        $requeteUploadPhotoProfile = "UPDATE users SET image = '$nomFinalDuFichier' WHERE id= '$userId'";
                        $resultatRequete = mysqli_query($maConnexion, $requeteUploadPhotoProfile);

                        if($resultatRequete){
                            header("location: profil.php?profile=$userId&info=picUploaded");
                        }else{
                            die(mysqli_error($maConnexion));
                        }
                    } else{
                    header("location: profil.php?profile=$userId&info=uploadFailed");
                    }
                }else{
                    header("location: profil.php?profile=$userId&info=resolution");
                }


            }else{
                header("location: profil.php?profile=$userId&info=oversized");
            }
        }else{
            header("location: profil.php?profile=$userId&info=extension");
        }
        

        } else {
            echo "ce n'est pas votre profil";
        }

    }
}



//modifier un profil

if(isset($_POST['userIdAModifier']) && $_POST['userIdAModifier'] !=""){
    $userId = $_POST['userIdAModifier'];

    if($_SESSION['userId'] == $userId){
    $newEmailEdition = $_POST['displayEmail'];
    $newDisplayNameEdition = $_POST['displayNameProfil'];

        $MaRequeteProfilModifier = "UPDATE users SET email = '$newEmailEdition', displayName = '$newDisplayNameEdition' WHERE id = $userId";
        $leResultatProfilModifier = mysqli_query($maConnexion, $MaRequeteProfilModifier);
         if(!$leResultatProfilModifier){
                     die(mysqli_error($maConnexion));
                  }else{
                     header("Location: profil.php?profile=$userId&info=edited");

                  }

    }else{
    die("vous n'avez pas le droit de modifier ce profil");
    }
}
      


// requete pour recupérer données des profils et afficher

 if( 
     (isset($_GET['profile']) && $_GET['profile'] != "")
     ||
    (isset($_POST['profilEdit']) && $_POST['profilEdit'] != "")
 ){
     if(isset($_POST['profilEdit'])){
    $userId = $_POST['profilEdit'];
    $maRequeteProfil = "SELECT id, username, displayName, email, image FROM users WHERE id = '$userId'";
    }else{
    $userId = $_GET['profile'];
    $maRequeteProfil = "SELECT username, displayName, email, image FROM users WHERE id = '$userId'";
    }

      $resultProfil = mysqli_query($maConnexion, $maRequeteProfil);

      if($isLoggedIn && $_SESSION['userId'] == $userId){
          $isUser = true;
      }
}


// supprimer un article
if(isset($_GET['delete'])){
$deleteArticle = $_GET['delete'];

if($isLoggedIn && verifyOwnership($_SESSION['userId'], $deleteArticle, $maConnexion)){
$maRequeteDelete = "DELETE FROM posts WHERE id = $deleteArticle";
$leResultatDeleteArticle = mysqli_query($maConnexion, $maRequeteDelete);
header('Location: ../index.php');
}else {
    header('Location: ../index.php?info=pasLeDroit');
}
}
  
    



//modifier un article

if(isset($_POST['modifierTitre']) && isset($_POST['modifierTexte']) ){
    if($_POST['modifierTitre'] !=="" && $_POST['modifierTexte'] !==""){
        $modifierTitre = $_POST['modifierTitre'];
        $modifierTexte = $_POST['modifierTexte'];
        $articleEdition = $_POST['id'];

       if($isLoggedIn && verifyOwnership($_SESSION['userId'], $articleEdition, $maConnexion) ){
    
        $maRequeteModifier = "UPDATE posts SET title = '$modifierTitre', content = '$modifierTexte' WHERE id = $articleEdition";
        $leResultatModificationArticle = mysqli_query($maConnexion, $maRequeteModifier);
        header('Location: ../index.php?modif=modification');
        }

        
    }
}

//creation d'article

if(isset($_POST['nouveauTitre']) && isset($_POST['nouveauTexte']) ){
    if($_POST['nouveauTitre'] !=="" && $_POST['nouveauTexte'] !==""){
        $nouveauTitre = $_POST['nouveauTitre'];
        $nouveauTexte = $_POST['nouveauTexte'];
        $authorId= $_SESSION['userId'];
        $statusUpload = "default";
//si il y a upload de photo
        if(isset($_FILES['uploadPostPic']['name']) && $_FILES['uploadPostPic']['name'] != "" ){

            $extensionsAutorisees = array("jpeg", "jpg", "png");
            $hauteurMax = 1081;
            $largeurMax = 1081;
            $repertoireUpload = "../images/posts/";
            $tailleMax = 3000000;

            $nomTemporaireFichier = $_FILES['uploadPostPic']['tmp_name'];
       
            $mesInfos = getimagesize($_FILES['uploadPostPic']['tmp_name']);

            $monTableauExtension = explode("/",$mesInfos['mime']);
            $extensionUpload = $monTableauExtension[1];
            $maLargeur = $mesInfos[0];
            $maHauteur = $mesInfos[1];
            $maTaille = $_FILES['uploadPostPic']['size'];

             $tableauTmpName = explode("\\",$nomTemporaireFichier);
        $nomFichier = end($tableauTmpName);

        $nomFinalDuFichier = $nomFichier.'.'.$extensionUpload;
        $destinationFinale = $repertoireUpload.$nomFinalDuFichier;

        //appeler methode pr deplacer le fichier depuis le cache dans la destination finale
        
        if(in_array($extensionUpload, $extensionsAutorisees)){
            if($maTaille <= $tailleMax){
                if($maLargeur <= $largeurMax && $maHauteur <= $hauteurMax){
                    if(move_uploaded_file($nomTemporaireFichier, $destinationFinale)){
                        echo "bravo fichier est envoyé";
                        $statusUpload = "added";
                        var_dump($statusUpload);
                         $maRequete = "INSERT INTO posts(title, content, authorId, image) VALUES ('$nouveauTitre', '$nouveauTexte', '$authorId', '$nomFinalDuFichier')";
                        
                    } else{
                    $statusUpload = "failed";
                    }
                }else{
                    $statusUpload = "resolution";
                }


            }else{
                $statusUpload = "oversized";
            }
        }else{
            $statusUpload = "extension";
        }


    }else{
            $maRequete = "INSERT INTO posts(title, content, authorId, image) VALUES ('$nouveauTitre', '$nouveauTexte', '$authorId', 'defautpost.png')";
    }

        $leResultatDeMonAjoutArticle= mysqli_query($maConnexion, $maRequete);

        
       if(!$leResultatDeMonAjoutArticle){
           die("RAPPORT ERREUR".mysqli_error($maConnexion));
           
        }
        header("Location: ../index.php?info=$statusUpload");
    }else{
    echo "remplis ton formulaire en entier";
    }

}
//effectuer une requete pour un article spécifique

if(isset($_GET['postId']) || isset($_POST['postId']) ){

    if(isset($_GET['postId'])){
    $postId = $_GET['postId'];
    }else{
    $postId = $_POST['postId'];
    }

    if($isLoggedIn){
    if(verifyOwnership($_SESSION['userId'], $postId, $maConnexion)){
        $isOwner = true;
    }
    }

$maRequeteArticleUnique = "SELECT * FROM posts WHERE id=$postId";

$leResultatDeMaRequeteArticleUnique = mysqli_query($maConnexion, $maRequeteArticleUnique);
$mesCommentaires = getCommentsByPostId($postId, $maConnexion);

}else if(isset($_POST['myPosts']) && $isLoggedIn){

            $userId = $_SESSION['userId'];
            $maRequeteMyPost ="SELECT posts.image, posts.title, posts.content, posts.authorId, posts.published, posts.id, users.username, users.displayName 
             FROM posts INNER JOIN users ON users.id = posts.authorId WHERE authorId = $userId";
            $leResultatRequete = mysqli_query($maConnexion, $maRequeteMyPost);
         

} else {



//effectuer une requete sql

$maRequete = "SELECT posts.image, posts.title, posts.content, posts.authorId, posts.id, users.username, users.displayName FROM posts INNER JOIN users ON users.id = posts.authorId WHERE posts.published = 1";

$leResultatRequete = mysqli_query($maConnexion, $maRequete);

}



function verifyOwnership($userId, $postId, $maConnexion){

$userId = $_SESSION['userId'];
$maRequeteDeVerification = "SELECT * FROM posts WHERE id ='$postId'";
$resultatRequeteVerification = mysqli_query($maConnexion, $maRequeteDeVerification);

foreach($resultatRequeteVerification as $value){
    $authorId = $value['authorId'];
}
    if($userId == $authorId){
         $ownerVerified = true;
    } else {
        $ownerVerified = false;
    }

    if($ownerVerified){

               return true;
            }else{

               return false;
            }
   
}

    function getDisplayNameById($userId, $maConnection){
            $requete = "SELECT displayName FROM users WHERE id='$userId'";


      }


function getCommentsByPostId($postId, $maConnexion){

    $maRequeteComments = "SELECT comments.content, users.displayName, users.username FROM comments INNER JOIN users ON comments.authorId = users.id WHERE comments.postId = '$postId'";

    $resultatRequeteComments = mysqli_query($maConnexion, $maRequeteComments);

    return $resultatRequeteComments;
}


//creation de commentaires


    if(isset($_POST['comment']) && $_POST['comment'] !="" && $isLoggedIn){

    $nouveauCom = $_POST['comment'];
    $postToComment = $_POST['postToComment'];
    $commentAuthor= $_POST['commentAuthor'];

    if($commentAuthor == $_SESSION['userId'] && $postToComment != ""){
       $requeteCommentairePoster = "INSERT INTO comments(content, authorId, postId) VALUES ('$nouveauCom', '$commentAuthor', '$postToComment')";

       $resultatRequeteCommentaire = mysqli_query($maConnexion, $requeteCommentairePoster);

       if($resultatRequeteCommentaire){
        header("location: postUnique.php?postId=$postToComment&info=commented");
       }else{
           die(mysqli_error($maConnexion));
       }
    }


}

//publier article

if (isset($_POST['publish']) && $_POST['publish']!="" ){
    $publier = $_POST['publish'];
    $author = $_POST['userId'];

    if($isLoggedIn && $author == $_SESSION['userId'] && verifyOwnership($author, $publier, $maConnexion)){
         $maRequetePubli = "UPDATE posts SET published = '1' WHERE id = $publier";
         $resultatRequetePubli = mysqli_query($maConnexion, $maRequetePubli);
         if($resultatRequetePubli){
             header("Location: postUnique.php?postId=$publier");
         }
    }
   
   
}


//depublier article

if (isset($_POST['unpublish']) ){
    $publier = $_POST['unpublish'];
    $author = $_POST['userId'];

    if($isLoggedIn && $author == $_SESSION['userId'] && verifyOwnership($author, $publier, $maConnexion)){
         $maRequetePubli = "UPDATE posts SET published = '0' WHERE id = $publier";
         $resultatRequetePubli = mysqli_query($maConnexion, $maRequetePubli);
         if($resultatRequetePubli){
             header("Location: postUnique.php?postId=$publier");
         }
    }
   
   
}

//requete afficher post admin 

if(isset($_SESSION['role']) && $isAdmin){
$maRequeteAdmin = "SELECT posts.title, posts.content, posts.published, posts.id, users.username, users.displayName FROM posts INNER JOIN users ON users.id = posts.authorId";
$resultatRequete = mysqli_query($maConnexion, $maRequeteAdmin);

}

?>
