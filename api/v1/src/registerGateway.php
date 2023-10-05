<?php

class registerGateway {
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    //check if username is in use
    public function usernameTaken(String $username) {
        $sql = "SELECT * FROM users WHERE Username = :username;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($result)
           return false;
        return true;
    }

    public function addUser($username, $password) {
        if(!usernameTaken($username)){
            $sql = "INSERT INTO users (Username, Password) VALUES (:username, :password);";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
        }
        else {
            //this needs to be changed
            echo "<p>Username Taken!</p><br>";
        }
    }
}