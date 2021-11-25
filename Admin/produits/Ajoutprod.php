<?php
session_start();

// 1- recuperation  des données de la formulaire

$nom = $_POST['nom'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$createur = $_SESSION['id'];
$categorie = $_POST['categorie'];
$quantite = $_POST['quantite'];
$date_creation = date('Y-m-d');
// uplad image

$target_dir = "../../images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
     $image = $_FILES["image"]["name"];
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
 
 try {

    // 2- connexin vers la base
 include "../../inc/fonctions.php";
 $conn = accesbd();

 // 3- creation de la req 

 $req = "INSERT INTO produits(nom,description,prix,categorie,image,createur,date_creation) VALUES ('$nom','$description','$prix','$categorie','$image','$createur','$date_creation' )";
 
 // 4-exection req
  $res = $conn->query($req);

 if ($res){
 //insertion l dernier id de produit avec la fonct lastinsertid
 $prod_id = $conn->lastInsertId();
 $req2 = "INSERT INTO stocks(produit,quantite,createur,date_creation) VALUES ('$prod_id','$quantite','$createur','$date_creation')";
 
 if($conn->query($req2)){ 
         header ('location:listeprod.php?ajout=ok'); // on fait un nv variable ajout envyées en url

 }else{
    echo "impossible d'ajouter le stock de produit";
 }
 }
    
   } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
     if($e->getcode() == 23000){
         header ('location:listeprod.php?erreur=duplicate');
     }
   }

?>