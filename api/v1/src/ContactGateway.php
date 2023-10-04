<?php
class ContactGateway
{
    private PDO $conn;
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getContacts(?int $id, object $para) : array | false
    {
        $append = false;
        $cond = "";

        if($para->first != ''){
            $append = true;
            $cond .= " AND SOUNDEX(FirstName) = SOUNDEX(:fn)";
        }

        if($para->last != ''){
            $append = true;
            $cond .= " AND SOUNDEX(LastName) = SOUNDEX(:ln)";
        }

        if($para->email != ''){
            $append = true;
            $cond .= " AND SOUNDEX(PrimaryEmail) = SOUNDEX(:pe)";
        }

        if($para->phone != ''){
            $append = true;
            $cond .= " AND SOUNDEX(PrimaryPhone) = SOUNDEX(:pp)";
        }

        if($id){
            $sql = "SELECT ContactId, FirstName, LastName, PrimaryEmail, PrimaryPhone FROM contacts WHERE UserId = :id";

            if($append){
                $sql .= $cond;
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if($para->first != '')
                $stmt->bindValue(":fn", $para->first, PDO::PARAM_STR);
            if($para->last != '')
                $stmt->bindValue(":ln", $para->last, PDO::PARAM_STR);
            if($para->email != '')
                $stmt->bindValue(":pe", $para->email, PDO::PARAM_STR);
            if($para->phone != '')
                $stmt->bindValue(":pp", $para->phone, PDO::PARAM_STR);
            

            $stmt->execute();
    
            $data = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
    
            return $data;
        }
        else{
            $sql = "SELECT ContactId, FirstName, LastName, PrimaryEmail, PrimaryPhone, UserId FROM contacts";

            $stmt = "";

            if(!$append)
                $stmt = $this->conn->query($sql);
            else{
                $sql .= " WHERE";
                $sql .= ltrim($cond, " AND ");
                $stmt = $this->conn->prepare($sql);

                if($para->first != '')
                    $stmt->bindValue(":fn", $para->first, PDO::PARAM_STR);
                if($para->last != '')
                    $stmt->bindValue(":ln", $para->last, PDO::PARAM_STR);
                if($para->email != '')
                    $stmt->bindValue(":pe", $para->email, PDO::PARAM_STR);
                if($para->phone != '')
                    $stmt->bindValue(":pp", $para->phone, PDO::PARAM_STR);

                $stmt->execute();
            }
            
    
            $data = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
    
            return $data;
        }
    }

    public function postContact(int $uid, object $para) : null
    {
        if($para->id == null)
        {
            http_response_code(400);
            echo json_encode("Missing Required Field: contactid");
        }
    }

    public function putContact(int $uid, object $para) : null
    {
        if($para->id == null)
        {
            http_response_code(400);
            echo json_encode("Missing Required Field: contactid");
        }
    }
}
?>
