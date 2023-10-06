<?php
header("Access-Control-Allow-Origin: *");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$components = explode("/", $_SERVER["REQUEST_URI"]);
$root = 3; //2 for deployment 3 for testing.
$path = $components[$root]; 
$componentLen = count($components);

if($path == null){
    print("Welcome to the API Root Directory!");
    exit;
}

$id = null;
if(($root+1) < $componentLen){
    $id = $components[$root + 1];
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

$requestBody = (object)json_decode(file_get_contents('php://input'));

if($path == "user"){
    $uG = new UserGateway($database);
    $userController = new UserController($uG, $requestBody);
    if($id){
        $userController->processRequest($_SERVER["REQUEST_METHOD"], intval($id), $requestBody);
    }
    else{
        $userController->processRequest($_SERVER["REQUEST_METHOD"], null, $requestBody);
    }
    exit;
}

if($path == "contacts"){
    $cpara = (new ContactParameters)->GetParameters($para);
    $cG = new ContactGateway($database);
    $contactController = new ContactController($cG);
    if($id){
        $contactController->processRequest($_SERVER["REQUEST_METHOD"], intval($id), $cpara, $requestBody);
    }
    else{
        $contactController->processRequest($_SERVER["REQUEST_METHOD"], null, $cpara, $requestBody);
    }
    exit;
}

if($path == "login"){
    $loginGate = new LoginGateway($database);
    $loginController = new LoginController($loginGate, $requestBody);
    $user = $loginController->processRequest($id, $para['password']);

    if($user == null) {
        echo json_encode("No Account matches username and password");
        http_response_code (404);
    }
    else {
        require_once "src/Config_Session.php";
        $_SESSION["user"] = $user;

        echo json_encode($user);
    }
    exit;
}

if($path == "register"){
    $registerGate = new RegisterGateway($database);
    $registerController = new RegisterController($registerGate, $requestBody);
    $user = $registerController->processRequest($requestBody->Username, $requestBody->Password, $requestBody->Confirm);
    json_encode($user);
    require_once "src/Config_Session.php";
    $_SESSION["user"] = $user;
    
    exit;
}   
http_response_code(404);
exit;
?>

