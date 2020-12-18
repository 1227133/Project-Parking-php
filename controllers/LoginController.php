<?php
session_start();
require_once dirname(dirname(__FILE__)). "/core/Authentication.php";

if (!empty($_POST) && isset($_POST["username"]) && !empty($_POST["username"])){
    // echo "your username is ".$_POST["username"];
} else {
    echo "your username is not set";

}

if (!empty($_POST) && isset($_POST["password"]) && !empty($_POST["password"])){
    // echo "<br>Your password is ".$_POST["password"];
} else {
    echo "Password is not set";
}

$username = $_POST["username"];
$password = $_POST["password"];
$hashedPassword = hash("sha512", $password); 

$auth = new Authentication();
$auth->login($username, $hashedPassword);