<?php

$idprod = $_GET['idc'];

include "../../inc/fonctions.php";

$conn = accesbd();
$req = " DELETE FROM produits WHERE id='$idprod'" ;
$res = $conn->query($req);

if($res){

    header ('location:listeprod.php?supp=ok');
}
 

?>