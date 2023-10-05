<?php

class loginController
{
    public function __construct(private loginGateway $gateway, private object $requestBody) {}

    public function processRequest(string $username, string $password) : void
    {
        $user = $this->gateway->getAccount($username, $password);
        if(empty($user)) {
            echo json_encode("No Account matches username and password");
        }
        else {
            echo json_encode($user);
        }
    }
}   
