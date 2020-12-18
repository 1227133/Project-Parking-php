<?php
require_once dirname(__FILE__). "/views/navi.php";

require_once dirname(__FILE__). "/views/homepage.html";
if(empty($_SESSION["uid"])) {
    header("Location: index.php");
}
require_once dirname(__FILE__). "/core/Authentication.php";

if (!empty($_POST) && 
    isset($_POST["logout"]) && 
    !empty($_POST["logout"])) {
    $auth = new Authentication();
    $auth->logout();
}
require_once dirname(__FILE__). "/repositories/ParkingRepository.php";
$parkingRepository = new ParkingRepository();
$spots = $parkingRepository->showAllSpots();  


echo "<table class ='table table-bordered text text-center table-hover'>
        <tr class='active'>
            <th class='text text-center'>Spot Status</th>
            <th class='text text-center'>Spot Number</th>
            <th class='text text-center'>Spot Description</th>
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
        </tr>";
}
        
echo"</table>";


require_once dirname(__FILE__). "/views/footer.html";
?>

