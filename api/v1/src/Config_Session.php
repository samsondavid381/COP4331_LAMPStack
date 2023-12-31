<?php

ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_set_cookie_params([
    'lifetime' => 0,
    'domain' => "localhost",
    'path' => "/",
    'secure' => false,
    'httponly' => false
]);

session_start();

if(!isset($_SESSION["last_regneration"])) {
    regenerateSession();
} else {
    $interval = 60 * 30;
    if(time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerateSession();
    }
}

function regenerateSession() {
    session_regenerate_id();
    $_SESSION["last_regenation"] = time();
}
