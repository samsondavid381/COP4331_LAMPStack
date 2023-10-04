<?php
class UserGateway
{
    private PDO $conn;
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAllUsers() : array | false
    {
        $sql = "SELECT UserId, Username FROM users";
        $stmt = $this->conn->query($sql);
        $data = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function getUser(int $id) : array | false
    {
        $sql = "SELECT UserId, Username FROM users WHERE UserId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function putUser(int $id, object $requestBody)
    {
        $succ = false;
        
        if($requestBody->Username != null && strlen($requestBody->Username) > 5){
            $sql = "UPDATE users SET Username = :us WHERE UserId = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->bindValue(":us", $requestBody->Username, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $succ = true;
        }

        if($requestBody->Password != null && strlen($requestBody->Password) > 8){
            $sql = "UPDATE users SET Password = :pa WHERE UserId = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->bindValue(":pa", $requestBody->Password, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $succ = true;
        }

        if(!$succ){
            http_response_code(400);
            echo "Request body was empty or invalid.";
            exit;
        }
    }
}
?>
