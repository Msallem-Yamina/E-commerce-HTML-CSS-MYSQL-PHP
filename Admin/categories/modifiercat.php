<?php
session_start();

// 1- recuperation  des données de la formulaire

$nom = $_POST['nom'];
$description = $_POST['description'];
$date_modification = date('Y-m-d'); // fonction predefinie en php.
$idcat = $_POST['idc'];
// 2- connexin vers la base
include "../../inc/fonctions.php";
$conn = accesbd();

// 3- creation de la req 

$req = "UPDATE categories SET nom='$nom', description='$description', date_modification='$date_modification' WHERE id='$idcat'";

// 4-exection req

$res = $conn->query($req);

if ($res){
    header ('location:listecat.php?modif=ok'); // on fait un nv variable ajout envyées en url
}

?>