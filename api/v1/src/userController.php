<?php

class UserController
{
    public function __construct(private UserGateWay $gateway)
    {}
    
    public function processRequest(string $method, ?string $id) : void
    {
        if($id){
            $this->processResourceRequest($method, $id);
        } else {
            http_response_code(400);
        }
    }

    public function processResourceRequest(string $method, int $id) : void
    {
        switch($method){
            case "GET":
                $user = $this->gateway->get($id);
                echo json_encode();
                break;
            default:
                http_response_code(400);
                exit;
        }
    }
}