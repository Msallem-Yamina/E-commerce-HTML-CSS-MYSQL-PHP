<?php

session_start();

$id=$_GET['idp'];

$_SESSION['panier'][3][$id]; 

// var_dump($_SESSION['panier'][3][$id]); 

$total_enlever = $_SESSION['panier'][3][$id][1];
$_SESSION['panier'][1] -= $total_enlever;
unset($_SESSION['panier'][3][$id]); 

// var_dump($_SESSION['panier'][3]); 

header ('location:../panier.php');




?>