<?php

define('APP_ROOT', __DIR__ . '/../'); // Path to the root of the application
define('APP_PATH', APP_ROOT . 'app/');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once APP_PATH . "DatabaseController.php";
require_once APP_PATH . "DataController.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}