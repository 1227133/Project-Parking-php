<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
<body class='body text'>
    <nav class="navbar-inverse navbar-fixed-top text text-center" style='margin:auto; text-align:center'>
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand text text-center" href="http://localhost/Parking/homepage.php">ParkIT <i class="fa fa-car" style="font-size:30px;color:#d9534f;"></i></a>
            </div>

          <ul class="nav navbar-nav ">
              <li class="active nav-link" ><a href="/Parking/homepage.php"><i class="fa fa-fw fa-home" style='color:#d9534f'></i>Home</a></li>
              <li  ><a class='nav-link' href="/Parking/views/myreservation.php">My Reservations</a></li> 
              <li><a class='nav-link' href="/Parking/parkingstatus.php">Make Reservation</a></li>
              <?php
                  session_start();
                  $mainAdmin = 6;
                  require_once dirname(dirname(__FILE__)). "/repositories/UserRepository.php";
                  $userRepository = new UserRepository();
                  if(empty($_SESSION["uid"])) {
                    header("Location: index.php");
                  }
                  $user = $userRepository->showUser($_SESSION['uid']);
                  if($user['id'] == $mainAdmin || $user['access'] == false) {
                      echo '<li><a href="/Parking/controlpanel.php">Control Panel</a></li>';
                  }
              ?>
          </ul>
          <ul class="nav navbar-nav navbar-right" style='padding:4px 4px 4px 4px' >   
              <li>
                      <form method="POST" action="homepage.php">
                      <input class="btn btn-n btn-danger" style='margin-top:3px' type="submit" name="logout" value="Logout">
                      </form>
              </li>
          </ul>
        </div>
    </nav>
    <br>
    <br>
