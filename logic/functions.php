<?php

function selectAll($table){
    global $conn;
    $query = "SELECT * FROM $table";
    $select = $conn->query($query);
    return $select->fetchAll();
}

function selectNavigation(){
    global $conn;
    $query = "SELECT * FROM navigation WHERE subname IS NULL";
    $select = $conn->query($query);
    return $select->fetchAll();

}

function printNavDdl($id,$name){
    global $conn;
    $upit = "SELECT * FROM navigation WHERE subname = $id";
    $select = $conn->query($upit)->fetchAll();
    $string = "";

    $string .= '<div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">'.$name.'</a>
                                    <div class="dropdown-menu rounded-0 m-0"> ';

    foreach ($select as $i){
        $string .= ' <a href="'.$i->path.'" class="dropdown-item">'.$i->name.'</a>';
    }
    $string .= '</div></div>';

    return $string;
}

function rentACar($limit=""){
    global $conn;
    $query = "SELECT * FROM vehicle v INNER JOIN price p ON v.price_id = p.price_id INNER JOIN model m ON v.model_id = m.model_id 
    INNER JOIN images i ON i.img_id = v.img_id $limit";
    $select = $conn->query($query);
    return $select->fetchAll();
}

function selectReviews(){
    global $conn;
    $query = "SELECT * FROM reviews r INNER JOIN customer c ON r.customer_id = c.customer_id WHERE r.active = 0";
    $select = $conn->query($query);
    return $select->fetchAll();
}

function galleryImages(){
    global $conn;
    $query = "SELECT img_src,alt FROM images WHERE img_id IN(SELECT img_id FROM gallery) 
               ORDER BY date_add DESC LIMIT 6";
    $select = $conn->query($query);
    return $select->fetchAll();
}

function sendMessage($name,$email,$subject,$message){
    global $conn;
    $query = "INSERT INTO messages(name,email,subject,text) VALUES (:name,:email,:subject,:text)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":name",$name);
    $insert->bindParam(":email",$email);
    $insert->bindParam(":subject",$subject);
    $insert->bindParam(":text",$message);
    $result = $insert->execute();
    return $result;
}

function modal($message,$class){
    echo '<div class="modal" id="modal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Message</h4>
                    <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="alert alert-'.$class.'">'.$message.'</p>
                  </div>
                </div>
              </div>
            </div>';
}

function registerUser($fName,$lName,$email,$pass,$phone,$driverL,$date){
    global $conn;
    $query = "INSERT INTO customer(first_name,last_name,email,password,phone,driver_license,birth_date,role_id) 
              VALUES(:fname,:lname,:email,:pass,:phone,:dLicense,:birth,2)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":fname",$fName);
    $insert->bindParam(":lname",$lName);
    $insert->bindParam(":email",$email);
    $insert->bindParam(":pass",$pass);
    $insert->bindParam(":phone",$phone);
    $insert->bindParam(":dLicense",$driverL);
    $insert->bindParam(":birth",$date);

    return $insert->execute();
}

function checkUserInformation($value,$checkValue){
    global $conn;
    $query = "SELECT COUNT(*) as nmbr from customer where $checkValue = '$value'";
    return $conn->query($query)->fetch();
}

function loginUser($email,$password){
    global $conn;
    $query = "SELECT * FROM customer c INNER JOIN role r ON c.role_id = r.role_id
              WHERE c.email = :email AND c.password = :password";
    $select = $conn->prepare($query);
    $select->bindParam(":email",$email);
    $select->bindParam(":password",$password);
    $select->execute();
    $result = $select->fetch();
    return $result;
}

function checkReservation($vehicleId,$startDate,$endDate) {
    global $conn;
    $query = "SELECT * 
              FROM reservation 
              WHERE vehicle_id = :vID AND (start_date BETWEEN :startDate AND :endDate 
               OR end_date BETWEEN :startDate AND :endDate)";
    $select = $conn->prepare($query);
    $select->bindParam(":vID",$vehicleId);
    $select->bindParam(":startDate",$startDate);
    $select->bindParam(":endDate",$endDate);
    $select->execute();

    $result = $select->fetchAll();

    return $result;

}

function dateCheck($time,$tmp){
    $string = "AM";
    if(str_contains($time,$string)){
        $time = $tmp;
    }
    else {
        $tmpHours = (int)explode(":",$tmp)[0];
        $tmpMin = (int)explode(":",$tmp)[1];
        if($tmpHours == 12){
            $tmpHours = 00;
            $time = $tmpHours . ":" . $tmpMin;
        }
        else {
            $tmpHours += 12;
            $time = $tmpHours . ":" . $tmpMin;
        }
    }
    return $time;
}

function insertReservation($userID,$startDate,$endDate,$vehicleID){
    global $conn;
    $priceQuery = "SELECT DATEDIFF('$endDate','$startDate') as days,p.price as price
    FROM vehicle v INNER JOIN price p ON v.price_id = p.price_id WHERE v.vehicle_id = :vehicleID";
    $select = $conn->prepare($priceQuery);
    $select->bindParam(":vehicleID",$vehicleID);
    $select->execute();
    $result = $select->fetch();
    $price = $result->price;
    $totalDays = $result->days;
    $totalPrice = $price * $totalDays;


    $query = "INSERT INTO reservation(customer_id,price,total_price,total_days,start_date,end_date,vehicle_id)
              VALUES (:userID,$price,$totalPrice,$totalDays,'$startDate','$endDate',:vehicleID)";
    $insert = $conn->prepare($query);
    $insert->bindParam("userID",$userID);
    $insert->bindParam(":vehicleID",$vehicleID);

    return $insert->execute();
}


function allReservations(){
    global $conn;
    $query = "SELECT v.vehicle_id,vehicle_name,r.*,c.* 
              FROM vehicle v INNER JOIN reservation r ON v.vehicle_id = r.vehicle_id 
              INNER JOIN customer c ON c.customer_id = r.customer_id INNER JOIN images i ON v.img_id = i.img_id";
    $select = $conn->query($query);
    return $select->fetchAll();
}

function getTotalPrice($check){
    global $conn;
    global $query;
    if($check == 'totalMonth'){
        $query = "SELECT total_price FROM reservation WHERE MONTH(CURRENT_DATE()) = MONTH(start_date)";
    }
    else if($check == 'total'){
        $query = "SELECT total_price FROM reservation";
    }
    $select = $conn->query($query);
    $select->execute();
    $reservationForMonth = $select->fetchAll();
    $totalPrice = 0;
    foreach ($reservationForMonth as $r){
        $totalPrice += $r->total_price;
    }
    return $totalPrice;
}

function getTotalReservation($check){
    global $conn;
    global $query;
    if($check == 'totalMonth'){
        $query = "SELECT COUNT(*) as reservationsNumber FROM reservation WHERE MONTH(CURRENT_DATE()) = MONTH(start_date)";
    }
    else if($check == 'total'){
        $query = "SELECT COUNT(*) as reservationsNumber FROM reservation WHERE MONTH(start_date) >= MONTH(CURRENT_DATE())";
    }
    $select = $conn->query($query);
    $select->execute();
    $numberR = $select->fetch();
    $numberR = $numberR->reservationsNumber;

    return $numberR;
}

function insertImage($src,$alt){
    global $conn;
    $queryImage = "INSERT INTO images(img_src,alt) VALUES('$src','$alt')";
    $conn->query($queryImage);

    $queryImgId = "SELECT img_id FROM images ORDER BY img_id DESC";
    $selectImgID = $conn->query($queryImgId);
    $selectImgID->execute();
    $ID = $selectImgID->fetch();
    $ID = $ID->img_id;

    return $ID;
}

function insertPrice($price){
    global $conn;
    $queryInsert = "INSERT INTO price (price) VALUES (:price)";
    $query = $conn->prepare($queryInsert);
    $query->bindParam(":price",$price);
    $res = $query->execute();

    $selectQuery = "SELECT * FROM price WHERE price = $price";
    $selectedPrice = $conn->query($selectQuery);
    $selectedPrice->execute();
    $insertPrice = $selectedPrice->fetch();
    $ID = $insertPrice->price_id;
    return $ID;
}

function checkPriceIfExists($price){
    global $conn;
    $queryPrice = "SELECT * FROM price WHERE price = :price";
    $selectPrice = $conn->prepare($queryPrice);
    $selectPrice->bindParam(":price",$price);
    $selectPrice->execute();
    $resPrice = $selectPrice->fetch();

    return $resPrice;
}

function checkImage($image,$imgLocation){
    $fileType = $image["type"];
    $fileSize = $image["size"];
    $extension = explode(".",$image["name"])[1];
    $fileName = uniqid() . "." . $extension;
    $folder = $imgLocation . $fileName;
    $tmpPath = $image["tmp_name"];
    $err = "";

    if($fileType != "image/jpeg" && $fileType != "image/png"){
        $err  = "Invalid file type. Only .jpg/.jpeg/.png";
    }
    else if($fileSize > 1024*1024*2){
        $err = "Image must be at most 2mb!";
    }
    else if(!move_uploaded_file($tmpPath,$folder)){
        $err = "Upload error";
    }

    return ["err" => $err,"fileName" => $fileName];
}

function selectReviewsById($ID){
    global $conn;
    $query = "SELECT * FROM reviews WHERE reviews_id = :ID";
    $select = $conn->prepare($query);
    $select->bindParam(":ID",$ID);
    $select->execute();
    $result = $select->fetch();

    return $result;
}

