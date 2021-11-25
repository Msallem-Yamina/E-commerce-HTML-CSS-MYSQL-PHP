
<?php
session_start();
include "../inc/fonctions.php";
if (isset($_POST['btnedit'])){
  if (Editadmin($_POST)){ //En fait un nouvelle session pr stcker les nouveaux données 
      $_SESSION['nom'] = $_POST['nom'];
      $_SESSION['email'] = $_POST['email'];
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Admin : Profile</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Espace Admin</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../deconnexion.php">Déconnexion</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
          <div class="row">
            <?php 
            include "template/sidebar.php";
            ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Profile </h1>
                <?php echo $_SESSION['nom'];?>
              </div>
              <h5> Informations personnels :</h5>
              <form action="profile.php" method="post">
                <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="idadmin">
                <div class="form-group">
                  <label> Addresse Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['email'];?>" placeholder="Tapez votre email..">
                </div>
                <div class="form-group">
                  <label >Nom</label>
                  <input type="text" name="nom" class="form-control" id="exampleInputPassword1" value="<?php echo $_SESSION['nom'];?>" placeholder="Tapez votre nom..">
                </div>
                <button type="submit" class="btn btn-primary" name="btnedit">Modifier</button>
              </form>
            </main>
         </div> 
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../js/jquery-slim.min.js"><\/script>')</script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    
  </body>
</html>
