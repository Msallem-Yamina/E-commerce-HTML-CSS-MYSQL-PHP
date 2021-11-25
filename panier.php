<?php
session_start();
include "inc/fonctions.php";
$totalglobal = 0;
if (isset($_SESSION['panier'])){
  $totalglobal = $_SESSION['panier'][1];
}
$categories = getAllcategories();


if(!empty($_POST)){ // si on clique sur le boutton search

        //echo "button search clicked";
       // echo $_POST['search'];
       $produits = searchproduit($_POST['search']);
  }else{
       $produits = getAllproducts();
      }
      $commandes = array(); 
      if(isset($_SESSION['panier'])){
        if(count(($_SESSION['panier'][3])) > 0){ // s'il y a une commande 
            $commandes = $_SESSION['panier'][3];            
        }

      }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <?php 
  include('inc/header.php');
  ?>

    <div class="container mt-3">
      <h1>Panier </h1>
      <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Produit</th>
              <th scope="col">Quantité</th>
              <th scope="col">Total</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($commandes as $index => $commande) {
             echo '<tr>
              <th scope="row">'.($index+1).'</th>
              <td>'.$commande['5'].'</td>
              <td>'.$commande['1'].' piéces</td>
              <td>'.$commande['2'].' DTT</td>
              <td> 
              <a href="action/supprprodpanier.php?idp='.$index.'" class="btn btn-danger" > Annuler </a>
              </td>
            </tr>';
            }
            ?>
            
          </tbody>
        </table>
        <div class="text-end">
          <h2>Total :<?php  
            echo $totalglobal;?> DTT
          </h2> 
          <hr   />
        <a href="action/validerpanier.php" class="btn btn-success" style="width: 100px;">Valider</a></div>
    </div>

    <!-- Footer-->
    <?php
    include ('inc/footer.php');
    ?>
    <!-- Fin Footer-->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>