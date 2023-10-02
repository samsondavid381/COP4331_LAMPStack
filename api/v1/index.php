<?php

$configs = include('config.php');
declare(strict_types=1);

spl_autoload_register(function($class){
    require __DIR__ . "/src/$class.php";
});

header("Content-type: application/json; charset=UTF-8");

$components = explode("/", $_SERVER["REQUEST_URI"]);
$path = $components[1];

$database = new Database($configs['host'], "Contact_Manager", $configs['username'], $configs['password']);
$database->getConnection();

if($path == "user"){
    $uG = new UserGateway($database);
    $userController = new UserController();
    $userController->processRequest($_SERVER["REQUEST_METHOD"], intval($components[2]))
    exit;
}

if($path == "contacts"){
    // $components[2] can be the id of the user, with an oauth key allowing access.
    exit;
}

if($path == "login"){
    // $components[2] needs to be the username of the user.
    exit;
}

if($path == "register"){

    exit;
}

http_response_code(404);
exit;
?>

