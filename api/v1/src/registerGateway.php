<?php

class registerGateway {
    private PDO $conn;
    private string $username;
    private string $password;

    public function __construct(Database $database, string $username, string $password)
    {
        $this->conn = $database->getConnection();
        $this->$username = $username;
        $this->$password = $password;
    }

    public function addUser() {
        $sql = "INSERT INTO users (Username, Password) VALUES (:username, :password);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
    }
}
