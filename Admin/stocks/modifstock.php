<?php
session_start();

// 1- recuperation  des données de la formulaire

$quantite = $_POST['quantite'];
$id = $_POST['idstock'];
// 2- connexin vers la base
include "../../inc/fonctions.php";
$conn = accesbd();

// 3- creation de la req 

$req = "UPDATE stocks SET quantite='$quantite' WHERE id='$id'";

// 4-exection req

$res = $conn->query($req);

if ($res){
    header ('location:listest.php?modif=ok'); // on fait un nv variable ajout envyées en url
}

?>