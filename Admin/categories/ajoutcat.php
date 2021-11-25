<?php
session_start();

// 1- recuperation  des données de la formulaire

$nom = $_POST['nom'];
$description = $_POST['description'];
$createur = $_SESSION['id'];
$date_creation = date('Y-m-d'); // fonction predefinie en php.


try {

    // 2- connexin vers la base
include "../../inc/fonctions.php";
$conn = accesbd();

// 3- creation de la req 

$req = "INSERT INTO categories(nom,description,createur,date_creation) VALUES ('$nom','$description','$createur','$date_creation')";

// 4-exection req

$res = $conn->query($req);

if ($res){
    header ('location:listecat.php?ajout=ok'); // on fait un nv variable ajout envyées en url
}
    
  } catch(PDOException $e) {
    // echo "Connection failed: " . $e->getMessage();
    if($e->getcode() == 23000){
        header ('location:listecat.php?erreur=duplicate');
    }
  }

?>