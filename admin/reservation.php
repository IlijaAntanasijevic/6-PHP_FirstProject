<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];
    if(!is_numeric($id)){
        header("Location: ../404.php");
        exit + die;
    }
    else {
        include_once "header.php";
        include "sidebar.php";

        global $conn;

        $query = "SELECT v.vehicle_id,vehicle_name,r.*,c.*,i.* 
              FROM vehicle v INNER JOIN reservation r ON v.vehicle_id = r.vehicle_id 
              INNER JOIN customer c ON c.customer_id = r.customer_id INNER JOIN images i ON v.img_id = i.img_id WHERE r.reservation_id = :id";
        $select = $conn->prepare($query);
        $select->bindParam(":id",$id);
        $select->execute();
        $resevation = $select->fetch();
    }
}

?>
<div class="content">
<?php include "navbar.php"; ?>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">

                <!--<a href="">Show All</a>-->
                <div class="row mb-5 mx-auto mt-3">
                    <div class="col-12">
                        <img src="../img/<?=$resevation->img_src?>" alt="<?=$resevation->alt?>" class="w-50">
                        <h1><?=$resevation->vehicle_name?></h1>
                    </div>
                </div>
            </div>

                <table class="table table-dark text-center align-middle  mb-5">
                    <tr class="text-white">
                        <th scope="col">Customer</th>
                        <th scope="col">Total price</th>
                        <th scope="col">price/day</th>
                        <th scope="col">Total days</th>
                    </tr>
                    <tr>
                        <td><?=$resevation->first_name ." ".$resevation->last_name?></td>
                        <td><?=$resevation->total_price?>$</td>
                        <td><?=$resevation->price?>$</td>
                        <td><?=$resevation->total_days?></td>
                    </tr>

                    </tbody>
                </table>
            <table class="table table-bordered text-center align-middle  mb-0">
                <tr class="text-white">
                    <th scope="col">Pickup date</th>
                    <th scope="col">Time</th>
                </tr>
                <tbody id="tableBody">
                <tr>
                    <td><?=date('Y-m-d',strtotime($resevation->start_date))?></td>
                    <td><?=date('H:i:s',strtotime($resevation->start_date))?></td>


                </tr>
                <tr class="text-white">
                    <th scope="col">Drop date</th>
                    <th scope="col">Time</th>
                </tr>
                <tr>
                    <td><?=date('Y-m-d',strtotime($resevation->end_date))?></td>
                    <td><?=date('H:i:s',strtotime($resevation->end_date))?></td>
                </tr>

            </table>

        </div>
    </div>

<?php
include "footer.php";
?>