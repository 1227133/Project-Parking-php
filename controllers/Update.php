<?php

require_once dirname(dirname(__FILE__)). "/repositories/ParkingRepository.php";

$parkingRepository = new ParkingRepository();

if (!empty($_POST['spot_id'])) {

    $spotID = $_POST['spot_id'];
    $spot = $parkingRepository->showSpot($spotID);

    if(!empty($spot)) {
        
        echo " <link rel='stylesheet' type='text/css' href='style.css'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

        <style>
        html,body{
        height:100%;
        padding:0;
        margin:0;
      }
      *{
        box-sizing:border-box;
      }
      .test{
        width:1000px;
        height:400px;
      }
      
      .box{
        
        width:100%;
        height:100%;
        
        display:flex;
        justify-content:center;
        align-items:center;
        
      }
      </style> 
        <div class='box'>
            <div class='test'>
                 <div class='row justify-content-center'>
                    <div class='col-md-7'>
                        <div class='card'>                                                  
                            <form class='text-center' method='POST' action='../controllers/Update.php?update_id=".$spot['id']."'>
                                    <h1 class='h1 font-effect-emboss'>Update Parking Spot</h1>
                                    <div class='form-group col-md-4 col-md-offset-4 align-center '>
                                        <label>Spot Number</label>
                                        <input class='form-control' type='text' name='SpotNumber' value='".$spot['SpotNumber']."'><br>
                                    </div>
                                    <div class='form-group col-md-4 col-md-offset-4 align-center '>
                                        <label>Spot Describtion</label>
                                        <textarea class='form-control' type='text' name='describtion'>".$spot['SpotDescribtion']."</textarea><br>
                                    </div>
                                    <div class='form-group col-md-4 col-md-offset-4 align-center '>    
                                        <button class='btn btn-primary' type='submit' name='update'>Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    } else {
        header("Location: ../controlpanel.php");
    }
} else if(!empty($_GET['update_id'])) {
    $spotId = $_GET['update_id'];
    $spotNumber = $_POST["SpotNumber"];
    $describtion = $_POST["describtion"];
    $update_data = [
        "spot_id" => $spotId,
        "spot_number" => $spotNumber,
        "describtion" => $describtion,
    ];
    $parkingRepository->updateSpotById($update_data);
    header("Location: ../controlpanel.php");
} else {
    header("Location: ../controlpanel.php");
}



