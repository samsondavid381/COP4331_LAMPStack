<?php

class registerController
{
    public function __construct(private registerGateway $gateway, private object $requestBody) {}

    public function processRequest(string $method, string $username, string $password, string $confirm) : void
    {
        if($password != $confirm)
        {
            http_response_code(400);
            echo json_encode("Passwords do not match");
            exit;
        }
        else {
            if($method == "POST") {
                $user = $this->gateway->addUser($username, $password);
                echo json_encode($user);
            }
            else 
            {
                http_response_code(400);
                echo json_encode("The Request Verb is invalid");
                exit;
            }
        }
    }
}  
