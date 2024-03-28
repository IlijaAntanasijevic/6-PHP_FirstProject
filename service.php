    
    <?php 
        require_once("includes/header.php")
    ?>



    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Service</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Service</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    

    <!-- Services Start -->
    <?php 
        include("includes/service.php")
    ?>
    <!-- Services End -->


    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="bg-banner py-5 px-4 text-center">
                <div class="py-5">
                    <h1 class="display-1 text-uppercase text-primary mb-4">50% OFF</h1>
                    <h1 class="text-uppercase text-light mb-4">Special Offer For New Members</h1>
                    <p class="mb-4">Only for Sunday from 1st Jan to 30th Jan 2045</p>
                    <?php if(!isset($_SESSION["user"])): ?>
                        <a class="btn btn-primary mt-2 py-3 px-5" href="register.php">Register Now</a>
                    <?php else: ?>
                        <a class="btn btn-primary mt-2 py-3 px-5" href="car.php">Booking Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Vendor Start -->
    <?php 
        include("includes/seller.php")
    ?>
    <!-- Vendor End -->


<?php 
    include("includes/footer.php")
?>