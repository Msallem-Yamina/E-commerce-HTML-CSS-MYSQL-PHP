<?php

function accesbd() {

    $servername = "localhost";
    $DBuser = "root";
    $DBpassword = "";
    $DBname = "ecommercephp";
    
    // connexion vers base de donnees 
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$DBname", $DBuser, $DBpassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    return $conn;
}

function getAllcategories(){
    
// 1- connexion vers bade de donnees 
$conn = accesbd();

// 2- creation de la requete

$requette = "SELECT * FROM categories";

// 3- execution de la requete

$resultat = $conn->query($requette);

// 4- resultat de la requete

$categories = $resultat->fetchAll();

//afficher les cat

//var_dump ($categories);

return $categories;

}

function getAllproducts(){
// 1- connexion vers bade de donnees 
$conn = accesbd();

// 2- creation de la requete

$requette = "SELECT * FROM produits";

// 3- execution de la requete

$resultat = $conn->query($requette);

// 4- resultat de la requete

$produits = $resultat->fetchAll();

return $produits;

}

function getAllpaniers(){
// 1- connexion vers bade de donnees 
$conn = accesbd();

// 2- creation de la requete

$req = "SELECT v.nom,p.total,p.date_creation,p.id,p.etat FROM paniers p , visiteurs v WHERE p.visiteur = v.id";

// 3- execution de la requete

$resultat = $conn->query($req);

// 4- resultat de la requete

$paniers = $resultat->fetchAll();

return $paniers;
}
 function searchproduit($keywords){

    // 1- connexion vers bade de donnees 
    $conn = accesbd();

    // 2- creation de la requete

    $requette = "SELECT * FROM produits where nom LIKE '%$keywords%'";

    // 3- execution de la requete

    $resultat = $conn->query($requette);

    // 4- resultat de la requete

    $produits = $resultat->fetchAll();

    return $produits;
 }

function getprodbyid($id){

    // 1- connexion vers bade de donnees 
    $conn = accesbd();

    // 2- creation de la requete

    $requette = " SELECT * FROM produits where id=$id ";

    // 3- execution de la requete

    $resultat = $conn->query($requette);

    // 4- resultat de la requete

    $produits = $resultat -> fetch();

    return $produits;
}

function AddVisiteur($data){

 // 1- connexion vers bade de donnees 
 $conn = accesbd();

 // 2- creation de la requete
 $mphash = md5($data['password']);
 $requette = "INSERT INTO visiteurs (nom,prenom,email,tel,password) VALUES('".$data['nom']."','".$data['prenom']."','".$data['email']."','".$data['tel']."','".$mphash."' ) ";

 // 3- execution de la requete

 $resultat = $conn->query($requette);

 // 4- resultat de la requete
     if ($resultat){
         return true;
     }else{
         return false;
     }
}
function login ($data){
     // 1- connexion vers bade de donnees 
     $conn = accesbd();

 // 2- creation de la requete

 $email = $data['email'];
 $password = md5($data['password']);

 $requette = "SELECT * FROM visiteurs WHERE email='$email' AND password='$password'";

 // 3- execution de la requete

 $resultat = $conn->query($requette);

$user = $resultat -> fetch();
 
// var_dump($user);

return $user;
}

function ConnectAdmin ($data){

// 1- connexion vers bade de donnees 

$conn = accesbd();

// 2- creation de la requete

$email = $data['email'];

$password = md5($data['password']);

$requette = "SELECT * FROM admins WHERE email='$email' AND password='$password'";

// 3- execution de la requete

$resultat = $conn->query($requette);

$user = $resultat -> fetch();

// var_dump($user);

return $user;
}
function getAllvisiteurs(){
    // 1- connexion vers bade de donnees 
$conn = accesbd();

// 2- creation de la requete

$requette = "SELECT * FROM visiteurs WHERE etat=0";

// 3- execution de la requete

$resultat = $conn->query($requette);

// 4- resultat de la requete

$visiteurs = $resultat->fetchAll();

return $visiteurs;
} 

function getstocks (){
    $conn = accesbd();
    // get les champs de 2 tables
    $req = "SELECT s.id,p.nom,s.quantite FROM produits p , stocks s WHERE p.id = s.produit";
    $res = $conn->query($req);
    $stocks = $res->fetchAll();
    return $stocks;
}

function getAllcmd(){
    // 1- connexion vers bade de donnees 
    $conn = accesbd();
    
    // 2- creation de la requete
    
    $req = "SELECT p.nom,p.image,c.quantite,c.total,c.panier FROM produits p , commandes c WHERE c.produit = p.id";
    
    // 3- execution de la requete
    
    $resultat = $conn->query($req);
    
    // 4- resultat de la requete
    
    $commandes = $resultat->fetchAll();
    
    return $commandes;
    }
    function changeretatpanier($data){
    // 1- connexion vers bade de donnees 
    $conn = accesbd();
        
    // 2- creation de la requete
    
    $req = "UPDATE paniers SET etat='".$data['etat']."' WHERE id='".$data['idpanier']."'";
    
    // 3- execution de la requete
    
    $resultat = $conn->query($req);
    
    }
    function getPanierByEtat($paniers,$etat){
    $panierEtat = array();

    foreach($paniers as $p) {
        if($p['etat'] == $etat){
            array_push($panierEtat,$p);
            }
        }
        return $panierEtat;
    }
    function Editadmin ($data){
        // 1- connexion vers bade de donnees 
    $conn = accesbd();
        if($data['nom'] != ""){ // si le nom nest pas vide / on teste sur ts les champs..
            $req = "UPDATE admins SET email='".$data['email']."', nom='".$data['nom']."' WHERE id='".$data['idadmin']."'";
        }else{ //en change les autres champs appart nom
            $req = "UPDATE admins SET email='".$data['email']."' WHERE id='".$data['idadmin']."'";
        }
    $resultat = $conn->query($req);
    return true;
    }
        function getdata(){
        $data = array();
        $conn = accesbd();
        // Nmbre des produits
        $req = "SELECT count(*) FROM produits " ;
        $res = $conn->query($req);
        $nbrprod = $res->fetch();
         // Nmbre des categories
         $req1 = "SELECT count(*) FROM categories " ;
         $res = $conn->query($req1);
         $nbrcat = $res->fetch();
          // Nmbre des visiteurs
        $req2 = "SELECT count(*) FROM visiteurs " ;
        $res =$conn->query($req2);
        $nbrclient = $res->fetch();

        $data["produits"] = $nbrprod[0];
        $data["categories"] = $nbrcat[0];
        $data["clients"] = $nbrclient[0];
        return $data;
    }
?>
