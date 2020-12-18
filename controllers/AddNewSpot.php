<?php
require_once dirname(dirname(__FILE__)). "/repositories/ParkingRepository.php";

$parkingRepository = new ParkingRepository();

if (!empty($_POST)) {
    if (
        !empty($_POST["SpotNumber"]) && 
        !empty($_POST["SpotDescription"])
    ) {
        if($parkingRepository->addNewSpot(
            $_POST["SpotNumber"],
            $_POST["SpotDescription"]
            )
        ) {
            header("Location: ../controlpanel.php");
        }
    } else { 
        echo "Error";
    }
}