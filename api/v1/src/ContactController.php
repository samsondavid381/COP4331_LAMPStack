<?php

class ContactController
{
    public function __construct(private ContactGateway $gateway)
    {}
    
    public function processRequest(string $method, ?int $uid, object $para) : void
    {
        if($uid){
            $contactList = $this->gateway->getContacts($uid, $para);
            switch($method){
                case "GET":
                    echo json_encode($contactList);
                    break;
                case "POST":
                    http_response_code(501);
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
