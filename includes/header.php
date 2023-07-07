<?php
session_start();
include "config/conf.php";
include "config/connection.php";
include "logic/functions.php";
$nav = selectNavigation();
global $infoCompany;
global $links;
//var_dump($_SESSION["user"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ROYAL CARS - Car Rental</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="rent a car,royal cars,car,Car Rental,ROYAL CARS" name="keywords"/>
    <meta content="ROYAL CARS! Explore in style with our premium rental cars - choose from a variety of luxury vehicles to make your next road trip unforgettable!" name="description"/>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" type="image/x-icon"/>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body pr-3" href="#"><i class="fa fa-phone-alt mr-2"></i><?= $infoCompany["phone"]; ?></a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href="#"><i class="fa fa-envelope mr-2"></i><?= $infoCompany["email"]; ?></a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <?php if(!isset($_SESSION["user"])):?>
                        <a class="text-body px-3" href="<?= $links["Register"] ?>"><?= array_search('register.php',$links) ?></a>
                        <a class="text-body px-3" href="<?= $links["Login"] ?>"><?= array_search('login.php',$links) ?> </a>
                        <a class="text-body px-3" href="<?= $links["facebook"] ?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-3" href="<?= $links["twitter"] ?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-3" href="<?= $links["linkedin"] ?>">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-3" href="<?= $links["instagram"] ?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body pl-3" href="<?= $links["youtube"] ?>">
                            <i class="fab fa-youtube"></i>
                        </a>
                    <?php else: ?>
                        <a class=" px-3 text-primary" href="logic/logut.php">Logout</a>
                        <?php
                         echo $_SESSION["user"]->first_name;
                         echo '<i class="fa fa-user ml-2" aria-hidden="true"></i>';
                         if($_SESSION["user"]->role_name == "admin"){
                             echo '<a class="px-3 text-primary" href="admin/admin.php">Admin</a>';
                         }
                        ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1 ml-lg-5">Royal Cars</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3 mr-lg-5" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <?php
                        foreach ($nav as $item){

                            if ($item->id_nav == 5){
                                echo printNavDdl(5,$item->name);
                            }
                            else {
                                echo "<a href='$item->path' class='nav-item nav-link'>$item->name</a>";
                                //echo '<a href="'.$item->path.'" class="nav-item nav-link">'.$item->name.'</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

