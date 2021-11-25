<?php

Session_start();

if (isset($_SESSION['nom'])){ // si user connecté
    header('location:profile.php');
}

include "inc/fonctions.php";

$categories = getAllcategories();
$alert = 0;

if (!empty($_POST)){

    if (AddVisiteur($_POST)){
        $alert = 1;
        // header ('location:connexion.php');
    };
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Css sweet alert 2-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.css" integrity="sha512-NIcYVd9x+7QWzVOrAepi4tT6Y17n9yiq7Jzc4T6FfSXPiI/+oB1j298Hufjj+Hr/9tjz9p0mSolx/OBRVPStLw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!--  Navbar -->
    <?php 
  include('inc/header.php');
  ?>
    <!-- Fin Navbar -->

    <div class="col-12 p-5">
        <h1 class="text-center"> Registre </h1>
        <form action="Registre.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label class="form-label">Prenom</label>
                <input type="text" name="prenom" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label class="form-label">Numer tél</label>
                <input type="text" name="tel" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-primary">Sauvgarder</button>
        </form>

    </div>

    <!-- Footer-->
    <?php
    include ('inc/footer.php');
    ?>
    <!-- Fin Footer-->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.js" integrity="sha512-mLrZ/I45W7yBc/QFrxW04Aj8Ly5T51AbqNk0buPhsslnMhb+oexiGE1UMuR4XFGQ2KkPazCWA9Cw/jwtkAd+aA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    if($alert == 1){
        print "
        <script>
        Swal.fire({
        icon: 'success',
        title: 'Your compte has been saved',
        timer: 1500
        })
        </script>
        ";
    }
        
?>


</html>