<?php
require_once dirname(dirname(__FILE__)). "/repositories/ParkingRepository.php";

$parkingRepository = new ParkingRepository();

if (!empty($_POST['delete'])) {
    $spot_id = $_POST['delete'];
    $parkingRepository->deleteSpotById($spot_id);
    header("Location: ../controlpanel.php");
} else {
    header("Location: ../controlpanel.php");
}