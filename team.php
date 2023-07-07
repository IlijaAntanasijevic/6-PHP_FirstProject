
    <!-- Search End -->
    <?php 
        require_once("includes/header.php");
    ?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">The Team</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">The Team</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Team Start -->
    <?php 
        include("includes/team.php");
    ?>
    <!-- Team End -->


    <!-- Vendor Start -->
    <?php 
        include("includes/seller.php");
    ?>
    <!-- Vendor End -->


<!-- Footer - END HTML -->

<?php 
    require_once("includes/footer.php")
?>