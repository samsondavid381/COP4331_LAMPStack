<?php

class UserController
{
    public function __construct(private UserGateWay $gateway)
    {}
    
    public function processRequest(string $method, ?int $id) : void
    {
        if($id){
            $this->processResourceRequest($method, $id);
        } else {
            http_response_code(400);
        }
    }

    public function processResourceRequest(string $method, int $id) : void
    {
        $user = $this->gateway->getUser($id);
        switch($method){
            case "GET":
                echo json_encode($user);
                break;
            default:
                http_response_code(400);
                exit;
        }
    }
}