
<?php
session_start();

include "../../inc/fonctions.php";

$categories = getAllcategories();
$produits = getAllproducts();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Admin : Produits</title>

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
            <h1 class="h2">Liste des Produits</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Ajouter un Produit
            </button>
          </div>
        <div>
        <?php
            if(isset($_GET['ajout']) && $_GET['ajout'] == "ok"){
                echo '<div class="alert alert-success"> Produit ajoutée avec success</div>';
            }
          ?>
           <?php
            if(isset($_GET['supp']) && $_GET['supp'] == "ok"){
                echo '<div class="alert alert-danger"> Produit supprimée avec success</div>';
            }
            ;
          ?>
  <table class="table table-bordered">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Description</th>
      <th scope="col">Prix</th>
      <th scope="col">Catégorie</th>
      <th scope="col">Image</th>
      <th scope="col">Date de création</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    
        
    $i = 0;
      foreach ($produits as $p ){
          $i++;
          echo ' <tr> 
          <th scope="row">'.$i.'</th>
          <td>'.$p['nom'].'</td>
          <td>'.$p['description'].'</td>
          <td>'.$p['prix'].'</td> 
          <td>'.$p['categorie'].'</td>
          <td><img src="../../images/'.$p['image'].'" width="100" height="80"></td>
          <td>'.$p['date_creation'].'</td>
          <td>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editmodal'.$p['id'].'">Modifier</button>
              <a onclick="return popUpdelete()" href="suppprod.php?idc='.$p['id'].'" class="btn btn-danger">Supprimer</a>
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

<!-- Modal Ajout-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout Un Nouveau Produits</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Ajoutprod.php" method="post" enctype="multipart/form-data">
            <div class="form-group" id="blocknom">
                 <input type="text" name="nom"  class="form-control" placeholder="Nom de produit..." >
            </div>
            <div class="form-group">
                 <textarea type="text" name="description" class="form-control" placeholder="description de produit..." ></textarea>
            </div>
            <div class="form-group">
                 <input type="number" step="0.01" name="prix"  class="form-control" placeholder="prix de produit..." >
            </div>
            <div class="form-group">
                 <input type="file" name="image"  class="form-control" placeholder="prix de produit..." >
            </div>
            <div class="form-group">
             <select name="categorie" class="form-control">
              <?php foreach ($categories as $cat ){
                  $i++;
                  echo '<option value="'.$cat['id'].'" >'.$cat['nom'].'</option>';
                  }
                ?>
             </select>
          </div>
          <div class="form-group">
            <input type="number" name="quantite" class="form-control" placeholder="Tapez la quantité de produit...">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
foreach ($produits as $index=>$p){?>
  <!-- Modal Modification-->
<div class="modal fade" id="editmodal<?php echo $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Produit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modifprod.php" method="post">
            <input type="hidden" name="idp" value="<?php echo $p['id']; ?>" />
            <div class="form-group">
                 <label for="nom">Nom de Produit :</label>
                 <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $p['nom'];?>">
            </div>
            <div class="form-group">
            <label for="description">Description de Produit :</label>
                 <textarea type="text" id="description" name="description" class="form-control"><?php echo $p['description'];?></textarea>
            </div>
            <div class="form-group">
                 <label for="prix">Prix de Produit : </label>
                 <input type="number" name="prix" id="nom" class="form-control" value="<?php echo $p['prix'];?>">
            </div>
            <div class="form-group">
                <label for="image">Image de Produit :</label>
                 <img src="../../images/<?php echo $p['image'];?>" width="70" height="50">
                 <input type="file" name="image" id="nom" class="form-control mt-2" value="">
            </div>
            <div class="form-group">
            <label for="categorie">Catégorie de Produit :</label>
             <select name="categorie" class="form-control">
              <?php foreach ($categories as $cat ){
                  $i++;
                  echo '<option value="'.$cat['id'].'" >'.$cat['nom'].'</option>';
                  }
                ?>
             </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Modifier</button>
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
  <script>
    function popUpdelete(){
      return confirm("Voulez-vous supprimer le produit?");
    }
  </script>
  </body>
</html>
