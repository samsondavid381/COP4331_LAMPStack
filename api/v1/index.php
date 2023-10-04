<?php
$components = explode("/", $_SERVER["REQUEST_URI"]);
$root = 3; //2 for deployment 3 for testing.
$path = $components[$root]; 
$componentLen = count($components);
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
    if(($root+1) > $componentLen){
        $userController->processRequest($_SERVER["REQUEST_METHOD"], intval($components[$root+1]));
    }
    else{
        $userController->processRequest($_SERVER["REQUEST_METHOD"], null);
    }
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

