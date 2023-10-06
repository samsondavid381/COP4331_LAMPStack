<?php

class RegisterController
{
    public function __construct(private RegisterGateway $gateway, private object $requestBody) {}

    public function processRequest(string $username, string $password, string $confirm) : void
    {
        if($password != $confirm)
        {
            echo json_encode("Passwords do not match");
            exit;
        }
        else {
            $user = $this->gateway->addUser($username, $password);
            echo json_encode($user);
        }
    }
}  
