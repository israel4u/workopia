<?php

require '../helpers.php';
require basePath('Framework/Database.php');
require basePath('Framework/Router.php');

// Instantiating the router
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get the current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Route the requests
$router->route($uri, $method); 
