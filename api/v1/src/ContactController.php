<?php

class ContactController
{
    public function __construct(private ContactGateway $gateway)
    {}
    
    public function processRequest(string $method, ?int $uid) : void
    {
        if($uid){
            $contactList = $this->gateway->getContacts($uid);
            switch($method){
                case "GET":
                    echo json_encode($contactList);
                    break;
                default:
                    http_response_code(400);
                    exit;
            }
        }
        else{
            $contactList = $this->gateway->getContacts();
            switch($method){
                case "GET":
                    echo json_encode($contactList);
                    break;
                default:
                    http_response_code(400);
                    exit;
            }
        }
    }
}
?>
