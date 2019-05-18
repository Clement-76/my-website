<?php

use App\Controller\HomeController;

require 'config.php';
require 'composer/vendor/autoload.php';

date_default_timezone_set(TIMEZONE);

session_start();

$router = new AltoRouter();

$router->setBasePath(rtrim($_SERVER['REQUEST_URI'], '/'));

$router->map('GET', '/', function() {
    $homeController = new HomeController();
    $homeController->displayHome();
});

$match = $router->match();

if(is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
