<?php

class LoginController
{
    public function __construct(private LoginGateway $gateway, private object $requestBody) {}

    public function processRequest(string $username, string $password)
    {
        $user = $this->gateway->getAccount($username, $password);
        return $user;
    }
}   
