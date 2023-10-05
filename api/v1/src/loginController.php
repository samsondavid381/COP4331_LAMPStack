<?php

class loginController
{
    public function __construct(private loginGateway $gateway, private object $requestBody) {}

    public function processRequest(string $method, string $username, string $password) : void
    {
        if($method == "POST") {
            $user = $this->gateway->getAccount($username, $password);
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
