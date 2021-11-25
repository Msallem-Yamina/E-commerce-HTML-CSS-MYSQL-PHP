
<?php
session_start();

include "../../inc/fonctions.php";

$paniers = getAllpaniers();
$commandes = getAllcmd();
if(isset($_POST['btnsubmit'])){
  // changer letat de panier
changeretatpanier($_POST);
}

if (isset($_POST['btnsearch'])){
  if ($_POST['etat'] == "tous"){
    $paniers = getAllpaniers();
  }else{
   $paniers = getPanierByEtat($paniers,$_POST['etat']);

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

    <title>Admin : Paniers</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Espace Admin</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../../deconnexion.php">Déconnexion</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
      <?php 
        include "../template/sidebar.php";
        ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Liste des Paniers</h1>
          </div>
        <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group d-flex">
              <select name="etat" class="form-control">
               <option >-- Choisir l'état -- </option>
               <option value="tous" >Tous</option>
                <option value="en cours" >En cours</option>
                <option value="en livraison" >En livraison</option>
                <option value="livraison terminée" >Livraison termineé</option>
              </select>              
              <button type="submit" class="btn btn-primary ml-2" name="btnsearch">cherhcer</button>
            </div>
           
         
         </form>
  <table class="table table-bordered">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Client</th>
      <th scope="col">Total</th>
      <th scope="col">Date</th>
      <th scope="col">Etat</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
   $i = 0;
      foreach ($paniers as $i=>$p ){
         $i++;
          echo ' <tr> 
          <th scope="row">'.$i.'</th>
          <td>'.$p['nom'].'</td>
          <td>'.$p['total'].'</td>
          <td>'.$p['date_creation'].'</td>
          <td>'.$p['etat'].'</td>
          <td>
          <button class="btn btn-success" data-toggle="modal" data-target="#commande'.$p['id'].'">Afficher</button>
          <a data-toggle="modal" data-target="#Traiter'.$p['id'].'" class="btn btn-primary" >Traiter</a>
          </td>
        </tr>';
      }
      ?>
   
  
  </tbody>
</table>
</div>
</main>
</div>
</div>
 
<!-- Modal Affichage-->
<?php

foreach ($paniers as $index=>$p){?>
<div class="modal fade" id="commande<?php echo $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Afficher liste des commandes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Nom produit</th>
            <th scope="col">Image</th>
            <th scope="col">Quantité</th>
            <th scope="col">Total</th>
            <th scope="col">Panier</th>
          </tr>
        </thead>
        <tbody>

        <?php

            foreach ($commandes as $c ){
              if ($c['panier'] == $p['id']){ // si commande appartient au panier ouvert.
                 print ' <tr> 
                <th scope="row">'.$c['nom'].'</th>
                <td><img src="../../images/'.$c['image'].'" width="100"></td>
                <td>'.$c['quantite'].'</td>
                <td>'.$c['total'].'</td>
               
              </tr>';
              }
               
            }
            ?>
        
        
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
}

// Modal traitement commande 

foreach ($paniers as $index => $p){?>
 
  <div class="modal fade" id="Traiter<?php echo $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Traiter les commandes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- php self cad en meme page laction dans notre cas en la page listecmd.php -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" value="<?php echo $p['id']; ?>" name="idpanier" />     
        <div class="form-group">
              <select name="etat" class="form-control">
                <option value="en cours" >En cours</option>
                <option value="en livraison" >En livraison</option>
                <option value="livraison terminée" >Livraison termineé</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="form-group btn btn-primary" name="btnsubmit">Sauvegarder</button>
            </div>
         </form>
      </div>
    </div>
  </div>
  <?php
  }


?>





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../js/jquery-slim.min.js"><\/script>')</script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  </body>
</html>
