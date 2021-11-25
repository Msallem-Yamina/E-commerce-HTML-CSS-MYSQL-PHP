<?php
session_start();
//  var_dump($_SESSION['panier'][1]);
//  exit();

include '../inc/fonctions.php';
$conn = accesbd();
$visiteur = $_SESSION['id'];
$total = $_SESSION['panier'][1];
$date = date('Y-m-d');

$req_pan = "INSERT INTO paniers (visiteur,total,date_creation,date_modification) VALUES ('$visiteur','$total','$date','$date')";
$res = $conn->query($req_pan);
$panier_id = $conn->lastInsertId();
$commandes = $_SESSION['panier'][3];

// Ajout la commande 

foreach ($commandes as $key => $commande) {
    $qte = $commande['1'];
    $total = $commande['2'];
    $idprod = $commande['0'];
    $req ="INSERT INTO commandes (produit,quantite,panier,total,date_creation,date_modification) VALUES ('$idprod','$qte','$panier_id','$total','$date','$date')";
    $res = $conn->query($req);
  ;
}

//  supprimer le panier
$_SESSION['panier'] = null;
header ('location:../index.php');
?>