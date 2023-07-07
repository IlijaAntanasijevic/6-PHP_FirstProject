<?php
include "config/connection.php";
global $conn;
/*
$price = 6555;
$upit = "INSERT INTO price (price) VALUES (:p)";
$query = $conn->prepare($upit);
$query->bindParam(":p",$price);
$res = $query->execute();

var_dump($res);

$price2 = 6555;
$queryPrice = "SELECT * FROM price WHERE price = :price";
$selectPrice = $conn->prepare($queryPrice);
$selectPrice->bindParam(":price",$price2);
$selectPrice->execute();
$resPrice = $selectPrice->fetch();
var_dump($resPrice);


 $price = 44444;
$queryPrice = "SELECT * FROM price WHERE price = :price";
$selectPrice = $conn->prepare($queryPrice);
$selectPrice->bindParam(":price",$price);
$selectPrice->execute();
$resPrice = $selectPrice->fetch();
 var_dump($resPrice);

$price = 5558985.99;
$insertPrice = 0;
$queryPrice = "SELECT * FROM price WHERE price = :price";
$selectPrice = $conn->prepare($queryPrice);
$selectPrice->bindParam(":price",$price);
$selectPrice->execute();
$resPrice = $selectPrice->fetch();
if(!$resPrice){
    $queryInsert = "INSERT INTO price (price) VALUES (:price)";
    $query = $conn->prepare($queryInsert);
    $query->bindParam(":price",$price);
    $res = $query->execute();

    $selectQuery = "SELECT * FROM price WHERE price = $price";
    $selectedPrice = $conn->query($selectQuery);
    $selectedPrice->execute();
    $insertPrice = $selectedPrice->fetch();
    $insertPrice = floatval($insertPrice->price);
    var_dump($insertPrice);
}
else {
    $insertPrice = floatval($resPrice->price);
}

var_dump($insertPrice);
*/


/*
$queryUpdateVehicle = "UPDATE vehicle
                                   SET vehicle_name = '$carName', description = '$description', licencse_plate = $licensePlate, img_id  = $imgId, price_id  = $priceID
                                   WHERE vehicle_id = $id";


            $updateVehicle = $conn->query($queryUpdateVehicle);
            $updateResult = $updateVehicle->execute();
*/

