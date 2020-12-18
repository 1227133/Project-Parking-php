<?php
session_start();
if(!empty($_SESSION["uid"])) {
    header("Location: homepage.php");
}

require_once dirname(__FILE__). "/views/loginpage.html";
?>
