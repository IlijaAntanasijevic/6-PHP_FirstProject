
    <!-- Header -->
    <?php 
        require_once("includes/header.php")
    ?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Testimonial</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Testimonial</h6>
        </div>
    </div>
    <!-- Page Header Start -->


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


    <!-- Vendor Start -->
    <?php 
        include("includes/seller.php")
    ?>
    <!-- Vendor End -->


     <!-- Footer - HTML END -->
     <?php
    require_once("includes/footer.php");
    ?>
    