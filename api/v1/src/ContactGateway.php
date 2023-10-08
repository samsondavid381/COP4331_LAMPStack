<?php
class ContactGateway
{
    private PDO $conn;
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getContacts(int $id, object $para) : array | false
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
                $sql .= " WHERE ";
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

    public function postContact(int $uid, object $para, object $requestBody)
    {
        $validated = (strlen($requestBody->FirstName) > 2) && (strlen($requestBody->LastName) > 2) && (strlen($requestBody->PrimaryEmail) > 5) && (strlen($requestBody->PrimaryPhone) == 14);
        if(!$validated){
            http_response_code(400);
            echo json_encode("Request body was empty or invalid.\n\nNames must be 3 or more characters.\nEmails must be at least 5 characters.\nPhone Numbers must follow the format `(XXX)-XXX-XXXX` exactly.");
            exit;
        }

        $sql = "INSERT INTO contacts (LastName, FirstName, PrimaryEmail, PrimaryPhone, UserId) VALUES (:ln, :fn, :pe, :pp, :ui);";
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindValue(":fn", $requestBody->FirstName, PDO::PARAM_STR);
        $stmt->bindValue(":ln", $requestBody->LastName, PDO::PARAM_STR);
        $stmt->bindValue(":pe", $requestBody->PrimaryEmail, PDO::PARAM_STR);
        $stmt->bindValue(":pp", $requestBody->PrimaryPhone, PDO::PARAM_STR);
        $stmt->bindValue(":ui", $uid, PDO::PARAM_INT);
        $stmt->execute();
        
    }

    public function putContact(int $uid, object $para, object $requestBody)
    {
        if($para->id == null)
        {
            http_response_code(400);
            echo json_encode("Missing Required Field: contactid");
            exit;
        }

        $succ = false;
        
        if($requestBody->FirstName != null && strlen($requestBody->FirstName) > 2){
            $sql = "UPDATE contacts SET FirstName = :fn WHERE UserId = :ui AND ContactId = :ci";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":ui", $uid, PDO::PARAM_INT);
            $stmt->bindValue(":ci", $para->id, PDO::PARAM_INT);
            $stmt->bindValue(":fn", $requestBody->FirstName, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $succ = true;
        }

        if($requestBody->LastName != null && strlen($requestBody->LastName) > 2){
            $sql = "UPDATE contacts SET LastName = :ln WHERE UserId = :ui AND ContactId = :ci";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":ui", $uid, PDO::PARAM_INT);
            $stmt->bindValue(":ci", $para->id, PDO::PARAM_INT);
            $stmt->bindValue(":ln", $requestBody->LastName, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $succ = true;
        }

        if($requestBody->PrimaryEmail != null && strlen($requestBody->PrimaryEmail) > 5){
            $sql = "UPDATE contacts SET PrimaryEmail = :pe WHERE UserId = :ui AND ContactId = :ci";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":ui", $uid, PDO::PARAM_INT);
            $stmt->bindValue(":ci", $para->id, PDO::PARAM_INT);
            $stmt->bindValue(":pe", $requestBody->PrimaryEmail, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $succ = true;
        }

        if($requestBody->PrimaryPhone != null && strlen($requestBody->PrimaryPhone) == 14){
            $sql = "UPDATE contacts SET PrimaryPhone = :pp WHERE UserId = :ui AND ContactId = :ci";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":ui", $uid, PDO::PARAM_INT);
            $stmt->bindValue(":ci", $para->id, PDO::PARAM_INT);
            $stmt->bindValue(":pp", $requestBody->PrimaryPhone, PDO::PARAM_STR);
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
