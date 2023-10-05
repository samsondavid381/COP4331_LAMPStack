<?php
class loginGateway
{
    private PDO $conn;
    private string $username;
    private string $password;

    public function __construct(Database $database, string $username, string $password)
    {
        $this->conn = $database->getConnection();
        $this->$username = $username;
        $this->$password = $password;
    }

    //This function gets all info from database on a user based on their username and password
    public function getAccount() {
        $sql = "SELECT * FROM users WHERE Username = :username AND Password = :password;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $password);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //if result is empty, username and/or password are wrong
        return $result;
    }
}
