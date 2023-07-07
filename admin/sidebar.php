<body>
<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <?php
    $class = "";
    $pos = strpos($_SERVER["PHP_SELF"],"vehicles.php");
    if($pos){
        $class = "open";
    }
     ?>
    <div class="sidebar pe-4 pb-3 <?= $class?>" >
        <nav class="navbar bg-secondary navbar-dark">
            <a href="admin.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Royal Cars</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="ms-3">
                    <h6 class="mb-0"><?= $_SESSION["user"]->first_name?></h6>
                    <span><?= $_SESSION["user"]->role_name?></span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="admin.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="vehicles.php" class="nav-link"><i class="fa fa-car me-2"></i>Vehicles</a>
                <a href="messages.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Messages</a>
                <a href="users.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Users</a>
                <a href="models.php" class="nav-item nav-link"><i class="fa fa-car me-2"></i>Models</a>
                <a href="reviews.php" class="nav-item nav-link"><i class="fa fa-star me-2"></i>Reviews</a>

            </div>
        </nav>
    </div>
    <!-- Sidebar End -->