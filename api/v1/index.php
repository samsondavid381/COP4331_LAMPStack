<?php
$components = explode("/", $_SERVER["REQUEST_URI"]);
$path = $components[2]; //set to $components[2] for deployment and $components[3] for testing!
if($path == null){
    print("Welcome to the API Root Directory!");
    exit;
}
$configs = include('config.php');

spl_autoload_register(function($class){
    require __DIR__ . "/src/$class.php";
});

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$database = new Database($configs->host, "contact_manager", $configs->username, $configs->password);

if($path == "user"){
    $uG = new UserGateway($database);
    $userController = new UserController($uG);
    $userController->processRequest($_SERVER["REQUEST_METHOD"], intval($components[3]));
    exit;
}

if($path == "contacts"){
    // $components[3] can be the id of the user, with an oauth key allowing access.
    http_response_code(501);
    exit;
}

if($path == "login"){
    // $components[3] needs to be the username of the user.
    http_response_code(501);
    exit;
}

if($path == "register"){
    http_response_code(501);
    exit;
}

http_response_code(404);
exit;
?>

