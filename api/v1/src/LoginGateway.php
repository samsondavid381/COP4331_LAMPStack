<?php
class LoginGateway
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    //This function gets all info from database on a user based on their username and password
    public function getAccount(string $username, string $password) {
        
        if(!empty($username) && !empty($password)){
            $sql = "SELECT UserId FROM users WHERE Username = :username AND Password = :password;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":password", $password);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            //if result is empty, username and/or password are wrong
            return $result;
        }
        else
        {
            echo json_encode("Please enter a username and password");
        }
    }
}
