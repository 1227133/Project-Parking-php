<?php
require_once dirname(dirname(__FILE__)). "/core/Db.php";

class UserRepository extends Db {
    function __constructor() {
        //TODO
    }
    
    public function addNewUser($username, $password) {
        $sql = "INSERT INTO 
                    user_credentials(id, username, password)
                VALUE (NULL, '".$username."', '".$password."')";
        $this->connection->exec($sql);
        return true;
    }

    public function getUserCredentials($username, $password) {
        $stmt = $this->connection->prepare (
                "SELECT 
                    * 
                FROM 
                    user_credentials
                WHERE
                    username = :username AND
                    password = :password
                LIMIT 1"
                );
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchAll();

        if(empty($user)) {
            return [];
        }
        else {
            return $user[0]; 
        }
    }

    public function showAllUsers () {
        $sql = "SELECT * FROM user_credentials";
        $result = $this->connection->query($sql);
        $allUsers = $result->fetchAll();

        if(!empty($allUsers)) {
            return $allUsers;
        } else {
            return [];
        }
    }

    public function showUser ($id) {
        $sql = "SELECT * FROM user_credentials WHERE id=".$id;
        $result = $this->connection->query($sql);
        $User = $result->fetch();

        if(!empty($User)) {
            return $User;
        } else {
            return [];
        }
    }

    public function promoteUser ($id) {
        $sql = "
            UPDATE 
                user_credentials
            SET 
                access=0
            WHERE id=".$id;
        $this->connection->exec($sql);
    }

    public function demoteUser ($id) {
        $sql = "
            UPDATE 
                user_credentials
            SET 
                access=1
            WHERE id=".$id;
        $this->connection->exec($sql);
    }
}