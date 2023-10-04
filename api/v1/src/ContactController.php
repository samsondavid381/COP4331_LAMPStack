<?php

class ContactController
{
    public function __construct(private ContactGateway $gateway)
    {}
    
    public function processRequest(string $method, ?int $uid, object $para, object $requestBody) : void
    {
        if($uid){
            $contactList = $this->gateway->getContacts($uid, $para);
            switch($method){
                case "GET":
                    echo json_encode($contactList);
                    break;
                case "PUT":
                    $this->gateway->putContact($uid, $para, $requestBody);
                    echo json_encode("Successfully Updated Contact!");
                    break;
                case "POST":
                    $this->gateway->postContact($uid, $para, $requestBody);
                    echo json_encode("Successfully Updated Contact!");
                    break;
                default:
                    http_response_code(400);
                    echo json_encode("The Request Verb is Invalid!");
                    exit;
            }
        }
        else{
            $contactList = $this->gateway->getContacts(null, $para);
            switch($method){
                case "GET":
                    echo json_encode($contactList);
                    break;
                default:
                    http_response_code(400);
                    echo json_encode("The Request Verb is Invalid!");
                    exit;
            }
        }
    }
}
?>
