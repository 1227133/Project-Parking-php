<?php
require_once "Db.php";
require_once dirname(dirname(__FILE__)). "/repositories/UserRepository.php";


class Authentication {
    private $username;
    private $password;

    private $userRepository;

    function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function login($usr, $pswd) {
        $this->username = $usr;
        $this->password = $pswd;

        $userFromDb = $this->userRepository->getUserCredentials($this->username, $this->password);
        if (!empty($userFromDb)) {
            $_SESSION["uid"] = $userFromDb["id"];
            header("Location: ../homepage.php");
        } else {
            header("Location: ../index.php");
        }
    
    }
    
    public function logout() {
        $_SESSION["uid"] = "";
        session_destroy();
        header("Location: index.php");
    }

}
