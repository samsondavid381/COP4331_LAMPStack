<?php

class UserController
{
    public function __construct(private UserGateway $gateway)
    {}
    
    public function processRequest(string $method, ?int $id) : void
    {
        if($id){
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    public function processResourceRequest(string $method, int $id) : void
    {
        $user = $this->gateway->getUser($id);
        switch($method){
            case "GET":
                echo json_encode($user);
                break;
            case "PUT":
                http_response_code(501);
                break;
            default:
                http_response_code(400);
                echo json_encode("The Request Verb is Invalid!");
                exit;
        }
    }

    public function processCollectionRequest(string $method) : void
    {
        $arr = $this->gateway->getAllUsers();
        switch($method){
            case "GET":
                echo json_encode($arr);
                break;
            default:
                http_response_code(400);
                echo json_encode("The Request Verb is Invalid!");
                exit;
        }
    }
}
?>
