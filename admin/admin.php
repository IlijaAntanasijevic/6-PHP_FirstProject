<?php
include_once "header.php";
include "sidebar.php";
global $conn;
if(!isset($_SESSION['user']) || $_SESSION['user']->role_name != 'admin'){
    header("Location: ../404.php");
    exit;
}
$allReservations = allReservations();
$totalPriceMonth = getTotalPrice('totalMonth');
$totalPrice = getTotalPrice("total");

$query = "SELECT vehicle_name,vehicle_id FROM vehicle WHERE vehicle_id IN (SELECT vehicle_id FROM reservation)";
$select = $conn->query($query);
$allCars =  $select->fetchAll();

$totalReservation = getTotalReservation("total");
$totalReservationMonth = getTotalReservation("totalMonth");

$nameArr = ["This Month","Total Sale","Total Reservation","This Month"];
$valuesArr = [$totalPriceMonth];




?>
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include "navbar.php"; ?>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">This Month</p>
                                <h6 class="mb-0">$<?= $totalPriceMonth?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$<?= $totalPrice?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Reservation</p>
                                <h6 class="mb-0"><?= $totalReservation?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">This Month</p>
                                <h6 class="mb-0"><?= $totalReservationMonth?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container mt-5 mb-2">
                <div class="row justify-content-evenly align-items-center">
                <div class="col-5">
                    <label for="" class="form-check-label">Sort by date:</label>
                    <select class="form-select bg-secondary border border-light text-white-50" aria-label="Default select example" id="sortDate">
                        <option value="0">Select...</option>
                        <option value="date-asc">Date ASC</option>
                        <option value="date-desc">Date DESC</option>
                    </select>
                </div>
                <div class="col-5 mb-2">
                    <label for="" class="form-check-label text-truncate">Sort by vehicle type:</label>
                    <select class="form-select bg-secondary border border-light text-light-50" aria-label="Default select example" id="sortVehicle">
                        <option value="0">Select...</option>
                        <?php foreach ($allCars as $car): ?>
                            <option value="<?= $car->vehicle_id?>"><?= $car->vehicle_name ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                </div>
            </div>

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Sales</h6>
                        <!--<a href="">Show All</a>-->
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white text-center h5">
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Pickup date</th>
                                    <!--<th scope="col">Time</th>-->
                                    <th scope="col">Drop date</th>
                                    <!--<th scope="col">Time</th>-->
                                    <th scope="col">Customer</th>
                                    <th scope="col">Total price</th>
                                    <th scope="col">price/day</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php foreach($allReservations as $res): ?>
                                    <tr class="text-center">
                                        <td><?=$res->vehicle_name?></td>
                                        <td><?=date('Y-m-d',strtotime($res->start_date))?></td>
                                        <!--<td><?=date('H:i:s',strtotime($res->start_date))?></td>-->
                                        <td><?=date('Y-m-d',strtotime($res->end_date))?></td>
                                        <!--<td><?=date('H:i:s',strtotime($res->end_date))?></td>-->
                                        <td><?=$res->first_name ." ".$res->last_name?></td>
                                        <td><?=$res->total_price?>$</td>
                                        <td><?=$res->price?>$</td>
                                        <td><a class="btn btn-sm btn-primary detailBtn" href="reservation.php?id=<?=$res->reservation_id?>" >Detail</a></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

<?php
include "footer.php";
?>