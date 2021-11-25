<?php

$idvisiteur = $_GET['id'];

include "../inc/fonctions.php";
$conn = accesbd();

$req = "UPDATE visiteurs SET etat=1 WHERE id='$idvisiteur'";
$res = $conn->query($req);
if ($res){
    header('location:Visiteurs.php?valider=ok');
    }else{
        echo "Erreur de validation";
    }
?>