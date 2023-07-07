<?php
include_once "header.php";
include_once "sidebar.php";
$allUsers = selectAll('customer');
global $conn;
?>

    <div class="content">
    <!-- Navbar Start -->
    <?php include "navbar.php"; ?>

    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Users</h6>
                <table class="table table-bordered border-dark">
                    <thead>
                    <tr>
                        <th scope="col" class="text-white">First Name</th>
                        <th scope="col" class="text-white">Last Name</th>
                        <th scope="col" class="text-white">Email</th>
                        <th scope="col" class="text-white">Phone</th>
                        <th scope="col" class="text-white">Driver License</th>
                        <th scope="col" class="text-white">Date of Birth</th>
                        <th scope="col" class="text-white text-center">Total <br> Reservation</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($allUsers as $user):

                        $id = $user->customer_id;
                        $query = "SELECT COUNT(*) as nmbr
                                  FROM reservation
                                  WHERE customer_id = $id";
                        $select = $conn->query($query);
                        $totalReservation =  $select->fetch();
                        $totalReservation = $totalReservation->nmbr;

                    ?>
                        <tr>
                            <td class="text-white"><?= $user->first_name ?></td>
                            <td class="text-white"><?= $user->last_name ?></td>
                            <td class="text-white"><?= $user->email ?></td>
                            <td class="text-white"><?= $user->phone ?></td>
                            <td class="text-white"><?= $user->driver_license ?></td>
                            <td class="text-white"><?= $user->birth_date ?></td>
                            <td class="text-white text-center"><?= $totalReservation ?></td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php include "footer.php"; ?>