<?php

use App\Controller\ContactController;
use App\Controller\HomeController;
use App\Controller\PageController;
use App\Controller\ProjectsController;
use App\Controller\UsersController;

require 'config.php';
require 'composer/vendor/autoload.php';

date_default_timezone_set(TIMEZONE);

session_start();

$router = new AltoRouter();
$router->setBasePath(BASEPATH);

$router->map('GET', '/', function() {
    $homeController = new HomeController();
    $homeController->displayHome();
});

$router->map('GET', '/projects/', function() {
    $projectController = new ProjectsController();
    $projectController->getJSONProjects();
});

$router->map('GET|POST', '/login/', function() {
    $userController = new UsersController();
    $userController->login();
});

$router->map('GET', '/logout/', function() {
    $userController = new UsersController();
    $userController->logout();
});

$router->map('POST', '/contact/', function() {
    $contactController = new ContactController();
    $contactController->sendMessage();
});

$router->map('GET', '/legal-notice/', function() {
    $pageController = new PageController();
    $pageController->displayLegalNotice();
});

$router->map('GET', '/admin/', function() {

});

$match = $router->match(rtrim($_SERVER['REQUEST_URI'], '/') . '/');

if(is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
