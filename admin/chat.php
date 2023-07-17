<?php
include_once "header.php";
include "sidebar.php";
global $conn;
if(!isset($_SESSION['user']) || $_SESSION['user']->role_name != 'admin'){
    header("Location: ../404.php");
    exit;
}
$adminName = $_SESSION["user"]->first_name;
include_once "sidebar.php";
?>
    <div class="d-none" id="adminName" data-name="<?= $adminName?>"></div>
    <div class="content">
        <!-- Navbar Start -->
        <?php include "navbar.php"; ?>

        <div class="container-fluid pt-4 px-4">
            <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">Chat</h6>
                    <div class="container" id="chatMess">
                        <div class="row" id="adminChatMessages">


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


<?php include "footer.php"; ?>