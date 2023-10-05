<?php

unset($_SESSION);
session_destroy();

header("Location: ../index.html");

die();
