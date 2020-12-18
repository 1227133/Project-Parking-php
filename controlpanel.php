<?php
require_once dirname(__FILE__). "/views/navi.php";
require_once dirname(__FILE__). "/repositories/UserRepository.php";
$mainAdmin = 6;
$userRepository = new UserRepository();
$user = $userRepository->showUser($_SESSION['uid']);
    if($user['id'] != $mainAdmin && $user['access'] != false) {
        header("Location: homepage.php");
    }



$users = $userRepository->showAllUsers();
require_once dirname(__FILE__). "/views/manageusers.html";



echo "<table  class='table table-bordered table-hover text text-center'>
        <tr class='active'>
            <th class='text text-center'>Username</th>
            <th class='text text-center'>User Status</th>
            <th class='text text-center'></th>
        </tr>";

foreach($users as $user) {
    if($user['access'] == false) {
        $decryptedBool = "Admin";
    } else {  
        $decryptedBool = "User";
    }
    echo "
        <tr class='active'>
            <td>".$user['username']."</td>
            <td>".$decryptedBool."</td>
            <td>";
            if($user['id'] != $mainAdmin) {
                if($user['access'] != false) {
                    echo "<form method='POST' action='controllers/UserManager.php'>
                        <button class='btn btn-success' type='submit' name='promote' value='".$user['id']."'>Promote</button>
                    </form>";
                } else {
                    echo "<form method='POST' action='controllers/UserManager.php'>
                        <button class='btn btn-danger' type='submit' name='demote' value='".$user['id']."'>Demote</button>
                    </form>";
                }
            }
    echo "
            </td>
        </tr>
    ";
}
echo "</table>";

require_once dirname(__FILE__). "/repositories/ParkingRepository.php";
$parkingRepository = new ParkingRepository();
$spots = $parkingRepository->showAllSpots();

require_once dirname(__FILE__). "/views/update.html";


echo "<table class ='table table-bordered text text-center table-hover'>
        <tr class='active'>
            <th class='text text-center'>Spot Status</th>
            <th class='text text-center'>Spot Number</th>
            <th class='text text-center'>Spot Describtion</th>
            <th class='text text-center'></th>
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
            <td>
                <form method='POST' action='./controllers/Update.php'>
                    <button class='btn btn-success' type='submit' name='spot_id' value='".$spot['id']."'>Upddate</button>
                </form>
            </td>
            <td>
                <form method='POST' action='./controllers/Delete.php'>    
                    <button class='btn btn-danger' type='submit' name='delete' value='".$spot['id']."'>Delete</button>
                </form>
            </td>
        </tr>
    ";
}
echo "</table>";

require_once dirname(__FILE__). "/views/createnew.html";

echo "<div id='divForm'>
        <div class='container'> 
            <form class='form-inline' method='POST' action='./controllers/AddNewSpot.php'>
                <div class='form-group'>
                    <label>Spot Number</label>
                    <input class='form-control' type='text' name='SpotNumber'>
                </div>
                <div class='form-group'>
                    <label>Spot Describtion</label>
                    <textarea class='form-control' type='text' name='SpotDescription'></textarea><br>
                </div>
                <div class='form-group'>
                    <button class='btn btn-success  ' type='submit' name='create'>Create</button>
                </div>
            </form>
        </div>
    </div>";


require_once dirname(__FILE__). "/views/footer.html";
?>