<?php

class loginController
{
    public function __construct(private loginGateway $gateway, private object $requestBody) {}

    public function processRequest(string $username, string $password) : void
    {
        $user = $this->gateway->getAccount($username, $password);
        echo json_encode($user);
    }
}   
