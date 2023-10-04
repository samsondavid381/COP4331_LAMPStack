<?php
$components = explode("/", $_SERVER["REQUEST_URI"]);
$root = 3; //2 for deployment 3 for testing.
$path = $components[$root]; 
$componentLen = count($components);
$id = null;
if(($root+1) < $componentLen){
    $id = $components[$root + 1];
}
if($path == null){
    print("Welcome to the API Root Directory!");
    exit;
}

$para = [];
if($id == null){
    $pathPBD = explode("?", $path);
    if(count($pathPBD) > 1){
        $path = $pathPBD[0];
        $paraString = explode("&", $pathPBD[1]);
        for($i = 0; $i < count($paraString); $i++){
            $split = explode("=", $paraString[$i]);
            $para[$split[0]] = $split[1];
        }
    }
}
else{
    $idPBD = explode("?", $id);
    if(count($idPBD) > 1){
        $id = $idPBD[0];
        $paraString = explode("&", $idPBD[1]);
        for($i = 0; $i < count($paraString); $i++){
            $split = explode("=", $paraString[$i]);
            $para[$split[0]] = $split[1];
        }
    }
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
    if($id){
        $userController->processRequest($_SERVER["REQUEST_METHOD"], intval($id));
    }
    else{
        $userController->processRequest($_SERVER["REQUEST_METHOD"], null);
    }
    exit;
}

if($path == "contacts"){
    $cpara = (new ContactParameters)->GetParameters($para);
    $cG = new ContactGateway($database);
    $contactController = new ContactController($cG);
    if($id){
        $contactController->processRequest($_SERVER["REQUEST_METHOD"], intval($id), $cpara);
    }
    else{
        $contactController->processRequest($_SERVER["REQUEST_METHOD"], null, $cpara);
    }
    exit;
}

if($path == "login"){
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

