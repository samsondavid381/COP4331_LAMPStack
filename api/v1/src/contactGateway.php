<?php
class UserGateway
{
    private PDO $conn;
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getContacts(?int $id) : array | false
    {
        if($id){
            $sql = "SELECT ContactId, FirstName, PrimaryEmail, PrimaryPhone FROM contacts WHERE UserId = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $data = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
    
            return $data;
        }
        else{
            $sql = "SELECT ContactId, FirstName, PrimaryEmail, PrimaryPhone, UserId FROM contacts";
            $stmt = $this->conn->query($sql);
    
            $data = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
    
            return $data;
        }
    }
}
?>