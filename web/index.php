<?php

// Boostrapping for configuration and autoloading
require_once __DIR__ . '/../src/bootstrap.php';

// Call frontController
$url = $_GET['url'];
$frontController = new FrontController();
$response = $frontController->handle($url);