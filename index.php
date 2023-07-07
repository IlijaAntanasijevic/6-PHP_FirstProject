    <!-- Header -->
    <?php
    require_once("includes/header.php");
    ?>


    <!-- Carousel Start -->
    <div class="container-fluid p-0" style="margin-bottom: 90px;">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Rent A Car</h4>
                            <h1 class="display-1 text-white mb-md-4">Best Rental Cars In Your Location</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Rent A Car</h4>
                            <h1 class="display-1 text-white mb-md-4">Quality Cars with Unlimited Miles</h1>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
   
    <?php
    include("includes/about.php");
    ?>
    <!-- About End -->


    <!-- Services Start -->
    <?php
    include("includes/service.php");
    ?>
    <!-- Services End -->


    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="bg-banner py-5 px-4 text-center">
                <div class="py-5">
                    <h1 class="display-1 text-uppercase text-primary mb-4">50% OFF</h1>
                    <h1 class="text-uppercase text-light mb-4">Special Offer For New Members</h1>
                    <p class="mb-4">Only for Sunday from 1st April to 30th April 2023</p>
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


    <!-- Rent A Car Start -->
    <?php
    include("includes/rentAcar.php");
    ?>
    <!-- Rent A Car End -->


    <!-- Team Start -->
    <?php
    include("includes/team.php");
    ?>
    <!-- Team End -->


    <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0">
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-secondary d-flex align-items-center justify-content-between"
                        style="height: 350px;">
                        <img class="img-fluid flex-shrink-0 ml-n5 w-50 mr-4" src="img/banner-left.png" alt="">
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
                        <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4" src="img/banner-right.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Testimonial Start -->
    <?php
    include("includes/testimonial.php")
    ?>
    <!-- Testimonial End -->

    <?php
    if(isset($_SESSION["user"]) && $_SESSION['user']->role_name == 'user'){
        global $conn;
        $userID = $_SESSION["user"]->customer_id;
        $query = "SELECT * FROM reservation WHERE customer_id = :uID";
        $select = $conn->prepare($query);
        $select->bindParam(":uID",$userID);
        $select->execute();
        $result = $select->rowCount();
    }
    global $result;
        if($result > 0){

    ?>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-6 h1">
                <a class="btn w-100 alert alert-success text-dark text-uppercase user-select-none" href="reviews.php" id="rate">Rate our services</a>
            </div>
        </div>
    </div>
        <?php } ?>
    <div id="modalRev"></div>




    <!-- Contact Start -->
    <?php 
    include_once("includes/contact.php");
    ?>
    <!-- Contact End -->


    <!-- Seller Start -->
    <?php
    include("includes/seller.php");
    ?>
    <!-- Seller End -->


    <!-- Footer - HTML END -->
    <?php
    require_once("includes/footer.php");
    ?>