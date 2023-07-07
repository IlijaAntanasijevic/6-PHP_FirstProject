<?php
include_once "header.php";
include "sidebar.php";
global $conn;
if(!isset($_SESSION['user']) || $_SESSION['user']->role_name != 'admin'){
    header("Location: ../404.php");
    exit;
}
$allCars = rentACar();

?>

<div class="content open">
    <!-- Navbar Start -->
    <?php
    include "navbar.php";

    if(isset($_GET["insertSucc"])): ?>
        <div id="modal" class="modal" tabindex="-1">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <button type="button" class="btn-close btnCloseDelete float-end " id="updateModal" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body mt-5">
                        <p class="alert alert-success h4">Successfully entered into the database</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-sm-12 col-12 p-3">
        <div class="bg-secondary rounded h-100 p-4 ">
            <h6 class="mb-4 text-center">ADD VEHICLE</h6>
            <div class="w-25 mx-auto">
                <a class="btn btn-success w-100 m-2" href="addNewVehicle.php">Add Vehicle</a>
            </div>
        </div>
    </div>
    <div class="col-12 p-3">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Vehicles</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Car image</th>
                        <th scope="col">Vehicle Name</th>
                        <th scope="col">Model Year</th>
                        <th scope="col">License Plate</th>
                        <th scope="col">Price/day</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $nmbr = 1; foreach ($allCars as $car): ?>
                        <tr id="row-<?= $car->vehicle_id ?>">
                            <th class="text-white" scope="row"><?= $nmbr ?></th>
                            <td class="w-25"><img src="../img/<?= $car->img_src ?>" class="w-50"></td>
                            <td class="text-white"><?= $car->vehicle_name ?></td>
                            <td class="text-white"><?= date('Y',strtotime($car->model_year)) ?></td>
                            <td class="text-white"><?= $car->licencse_plate ?></td>
                            <td class="text-white">$<?= $car->price ?></td>
                            <td><p class="btn btn-sm btn-danger btnDeleteVehicle" id="<?= $car->vehicle_id ?>" href="#">Delete</p></td>
                            <td><a class="btn btn-sm btn-primary btnUpdateVehicle" href="updateVehicle.php?id=<?=$car->vehicle_id?>">Update</a></td>
                        </tr>
                    <?php $nmbr++; endforeach; ?>

                    </tbody>
                </table>

            </div>
            <div id="modalDelete"></div>
        </div>
    </div>


<?php include "footer.php"; ?>