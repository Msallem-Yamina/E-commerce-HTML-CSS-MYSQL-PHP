<?php
// echo "id de cat ".$_GET['idc'];

$idcat = $_GET['idc'];

include "../../inc/fonctions.php";

$conn = accesbd();
$req = " DELETE FROM categories WHERE id='$idcat'" ;
$res = $conn->query($req);

if($res){
    // echo "cat supprimer";

    header ('location:listecat.php?supp=ok');
}


?>