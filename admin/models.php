<?php
include_once "header.php";
include "sidebar.php";
global $conn;
if(!isset($_SESSION['user']) || $_SESSION['user']->role_name != 'admin'){
    header("Location: ../404.php");
    exit;
}
$allModels = selectAll('model');


?>

    <div class="content">
    <!-- Navbar Start -->
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-12 p-3">
                <div class="bg-secondary rounded h-100 p-4 ">
                    <h6 class="mb-4 text-center">ADD MODEL</h6>
                    <div class="w-25 mx-auto">
                        <a class="btn btn-success w-100 m-2 " href="addNewModel.php">Add Model</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">Models</h6>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Model Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nmbr = 1; foreach ($allModels as $model): ?>
                        <tr id="row-<?=$model->model_id?>" class="align-middle">
                            <th scope="row"><?= $nmbr ?></th>
                            <td><?= $model->model_name ?></td>
                            <td class="w-25">
                                <img src="../img/<?=$model->img_src?>" alt="<?= $model->model_name ?>" class="w-25">
                            </td>
                            <td>
                               <a class="btn btn-sm btn-danger btnDeleteModel" id="<?= $model->model_id ?>" href="models.php?id=<?= $model->model_id ?>">Delete</a>
                            </td>
                        </tr>
                    <?php $nmbr++; endforeach; ?>

                    </tbody>
                </table>
                <div id="modalDelete"></div>
            </div>
        </div>
    </div>


<?php include "footer.php"; ?>