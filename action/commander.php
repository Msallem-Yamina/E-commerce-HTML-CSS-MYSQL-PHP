<?php
// //test user cncté
 Session_start();
if(!isset($_SESSION['nom'])){ // si user n est pas cncté
header ('location:../connexion.php');
exit();
}

include '../inc/fonctions.php';

$conn = accesbd();

// produit 
$idprod = $_POST['produit'];
$qte = $_POST['quantite']; 

$req = "SELECT prix, nom FROM produits WHERE id='$idprod'";
$res = $conn->query($req);
$produit = $res->fetch();

$total = $qte * $produit['prix'] ;

$date = date('Y-m-d');

// Panier 
$visiteur = $_SESSION['id'];

// Ajouter une nuvelle session stockées les données

if(!isset($_SESSION['panier'])){ // si panier n'existe pas
    $_SESSION['panier'] = array ($visiteur,0,$total, array()); //creation de panier

}
    $_SESSION['panier'][1] += $total; // += cad ancien valeur total + nouveau total jdid. 
    $_SESSION['panier'][3][] = array ($idprod,$qte,$total,$date,$date, $produit['nom']); //sinon on commander direct 

    

// var_dump($_SESSION['panier']); 
//  echo "commande panier";
//  var_dump($_SESSION['panier'][3]);
//  exit();

header ('location:../panier.php');

?>