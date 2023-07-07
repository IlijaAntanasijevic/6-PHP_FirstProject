
    <!-- Header -->

    <?php 
        require_once("includes/header.php")
    ?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">About</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">About</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- About Start -->
   <?php 
    include("includes/about.php")
   ?>
    <!-- About End -->


    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0">
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-secondary d-flex align-items-center justify-content-between" style="height: 350px;">
                        <img class="img-fluid flex-shrink-0 ml-n5 w-50 mr-4" src="img/banner-left.png" alt="banner"/>
                        <div class="text-right">
                            <h3 class="text-uppercase text-light mb-3">Want to be driver?</h3>
                            <p class="mb-4">Lorem justo sit sit ipsum eos lorem kasd, kasd labore</p>
                            <?php if(!isset($_SESSION["user"])): ?>
                                <a class="btn btn-primary py-2 px-4" href="register.php">Start Now</a>
                            <?php else: ?>
                                <a class="btn btn-primary py-2 px-4" href="car.php">Start Now</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-dark d-flex align-items-center justify-content-between" style="height: 350px;">
                        <div class="text-left">
                            <h3 class="text-uppercase text-light mb-3">Looking for a car?</h3>
                            <p class="mb-4">Lorem justo sit sit ipsum eos lorem kasd, kasd labore</p>
                            <?php if(!isset($_SESSION["user"])): ?>
                                <a class="btn btn-primary py-2 px-4" href="register.php">Start Now</a>
                            <?php else: ?>
                                <a class="btn btn-primary py-2 px-4" href="car.php">Start Now</a>
                            <?php endif; ?>
                        </div>
                        <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4" src="img/banner-right.png" alt="banner"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Vendor Start -->
    <?php 
                include("includes/seller.php");
              ?>
    <!-- Vendor End -->


    <!-- Footer Start -->
   <?php 
    include_once("includes/footer.php")
   ?>
    <!-- Footer End -->
