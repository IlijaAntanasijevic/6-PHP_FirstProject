<?php
include_once "header.php";
include "sidebar.php";
global $conn;
if(!isset($_SESSION['user']) || $_SESSION['user']->role_name != 'admin'){
    header("Location: ../404.php");
    exit;
}
include_once "sidebar.php";
$allMessages = selectAll('messages');
?>

    <div class="content">
    <!-- Navbar Start -->
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5 mb-3">
                <label for="" class="form-check-label text-truncate mt-4">Sort by date:</label>
                <select name="ddlSortMessage" id="ddlSortMessage" class="form-select bg-secondary border border-light text-light-50" aria-label="Default select example">
                    <option value="0">Choose...</option>
                    <option value="date-desc">Newest</option>
                    <option value="date-asc">Older</option>
                </select>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">Messages</h6>
                    <div class="container" id="mess">
                        <?php foreach ($allMessages as $msg): ?>
                        <div class="my-3 pt-4 border-top mt-5">
                        <div class="row h4 pb-3">
                            <div class="col-4">
                                 <p class="text-center text-light">Name</p>
                                 <p class="text-center"><?= $msg->name ?></p>

                            </div>
                            <div class="col-4">
                                <p class="text-center text-light">Email</p>
                                <p class="text-center"><?=$msg->email ?></>
                            </div>
                            <div class="col-4">
                                <p class="text-center text-light">Date</p>
                                <p class="text-center"><?= date("Y-m-d",strtotime($msg->date)) ?></p>
                            </div>
                            </div>
                        <div class="row my-5">
                            <div class="col-12">
                                <p class="text-center h4 ">Subject</p>
                                <p class="text-white text-center pt-0 px-3 pb-3"> <?= $msg->subject ?></p>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center h4" ">Message</p>
                                    <p class="text-white p-3 border border-light m-2 mb-5"><?= $msg->text ?></p>
                                </div>
                            </div>
                        </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                            <!--
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>

                            <td> //$msg->subject </td>
                                <td>< //$msg->text </td>
                            -->



                </div>
        </div>
    </div>


<?php include "footer.php"; ?>