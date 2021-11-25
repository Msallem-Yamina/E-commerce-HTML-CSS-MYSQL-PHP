<?php

session_start();

// 1- recuperation  des données de la formulaire

$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$image = $_POST['image'];
$categorie = $_POST['categorie'];
$date_modification = date('Y-m-d'); // fonction predefinie en php.
$idp = $_POST['idp'];


// 2- connexin vers la base
include "../../inc/fonctions.php";
$conn = accesbd();

// 3- creation de la req 

$req = "UPDATE produits SET nom='$nom', description='$description',prix='$prix', categorie='$categorie',image='$image',date_modification='$date_modification' WHERE id='$idp'";

// 4-exection req

$res = $conn->query($req);

if ($res){
    header ('location:listeprod.php?modif=ok'); // on fait un nv variable ajout envyées en url
}

?>