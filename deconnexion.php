<?php
session_start();
session_unset(); //supprimer les variables de session
session_destroy(); // supprimer session

header('location:index.php');

?>