<?php
require_once dirname(__FILE__). "/views/navi.php";
require_once dirname(__FILE__). "/views/parkingstatus.html";
          
require_once dirname(__FILE__). "/repositories/ParkingRepository.php";
$parkingRepository = new ParkingRepository();
//parking repo method if true ->
// //if true 'show user Spots
// $spotsData;
// $result = $parkingRepository->showSpot($_SESSION["uid"]);
    
// if (!empty($result)) {
//     $spot = $parkingRepository->getUserReservation($_SESSION["uid"]);
//     $spotsData = $spot;
// } else {
//      $sports = $resRepo->getAllSport();
//         $spots = $parkingRepository->showAllSpots();
//         $spotsData = $spots;   
// }
$spots = $parkingRepository->showAllSpots();

echo "<table class='table table-bordered table-hover text text-center' id='divForm'>
        <tr class='active'>
            <th class='text text-center'>Spot Status</th>
            <th class='text text-center'>Spot Number</th>
            <th class='text text-center'>Spot Describtion</th>
            <th></th>
        </tr>";

foreach($spots as $spot) {
    if($spot['FreeOrTaken'] == false) {
        $decryptedBool = "Taken";
    } else {  
        $decryptedBool = "Free";
    }
    echo "
        <tr class='active'>
            <td>".$decryptedBool."</td> 
            <td>".$spot['SpotNumber']."</td>
            <td>".$spot['SpotDescribtion']."</td>
            <td>";
                if($spot['FreeOrTaken'] != false) {
                    echo "<form method='POST' action='reservation.php'>
                        <button class='btn btn-success' type='submit' name='reserve' value='".$spot['id']."'>Reserve</button>
                    </form>";
                } else {
                    echo "<form method='POST' action='reservation.php'>
                        <button class='btn btn-danger' type='submit' name='release' value='".$spot['id']."'>Release</button>
                    </form>";
                }
    echo "
            </td>
        </tr>
    
    ";
}
echo"</table>";
require_once dirname(__FILE__). "/views/footer.html";
