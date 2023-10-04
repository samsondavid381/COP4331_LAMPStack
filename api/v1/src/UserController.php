<?php

class UserController
{
    public function __construct(private UserGateway $gateway, private object $requestBody)
    {}
    
    public function processRequest(string $method, ?int $id, object $requestBody) : void
    {
        if($id){
            $this->processResourceRequest($method, $id, $requestBody);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    public function processResourceRequest(string $method, int $id, object $requestBody) : void
    {
        switch($method){
            case "GET":
                $user = $this->gateway->getUser($id);
                echo json_encode($user);
                break;
            case "PUT":
                $this->gateway->putUser($id, $requestBody);
                echo json_encode("Successfully Updated User!");
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
