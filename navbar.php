 
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link" href="<?php echo $racineSite ?>">Accueil</a>
        </li>
        <?php if($isLoggedIn){?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $racineSite ?>/blog/create.php">Nouveau post</a>
        </li>
        <li>
        <form action="<?php echo $racineSite ?>/index.php" method="POST">
          <button type="submit" name="myPosts" class="btn btn-secondary my-2 my-sm-0">Mes Posts</button>
        </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $racineSite ?>/blog/profil.php?profile=<?php echo $_SESSION['userId']?>">Mon Profil</a>
        </li>
        <?php } ?>
      </ul>

      <?php if ($isAdmin){?>

        <form action="<?php echo $racineSite?>/blog/admin.php">
        
          <button type="submit" class="btn btn-primary" name="adminPage" value="all">Admin</button>
        
        </form>
      
      
      <?php } ?>
      <!-- Se connecter -->
        <?php if(!$isLoggedIn && !$modeInscription){ ?>
            <form class="d-flex" method= "POST">
                <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username">
                </div>

                <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                <input type="submit" value="Se connecter" class="btn btn-success my-4">
                </div>
    
            </form>
               <form method="POST">
                <button type="submit" class="btn btn-primary m-5" name="info" value="on">Inscription</button>
              </form>
            <?php } ?>

            <?php if($isLoggedIn){?>
                  <h2 class="me-5">Bonjour <?php
                  if($_SESSION['displayName'] == ""){
                    echo $_SESSION['username'];
                  }else{
                    echo $_SESSION['displayName'];
                  }
                  ?>
                  </h2>
                  <form method="POST"><button type="submit" name="logOut">Deconnexion</form>
                  
            <?php } ?>

    </div>
  </div>
</nav>