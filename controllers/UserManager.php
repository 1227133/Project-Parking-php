
<?php

require_once dirname(dirname(__FILE__)). "/repositories/UserRepository.php";

if(!empty($_POST['promote'])){
    $userid = $_POST['promote'];
} else {
    $userid = $_POST['demote'];
}

$userRepository = new UserRepository();
$user = $userRepository->showUser($userid);


if($user['access'] != false) {
    $userRepository->promoteUser($userid);
    header("Location: ../controlpanel.php");
} else {
    $userRepository->demoteUser($userid);
    header("Location: ../controlpanel.php");
}