<?php
require_once "Config_Session.php";

unset($_SESSION);
session_destroy();

header("Location: ../index.html");

die();
