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
}
?>