<?php

namespace App\Controller;

abstract class AppController {

    protected $twig;

    /**
     * AppController constructor.
     * Instantiates Twig_Loader_Filesystem and Twig_Environment classes
     * and stores $twig object into a property to reuse later in controllers
     */
    public function __construct() {
        $loader = new \Twig_Loader_Filesystem(ROOT . '/view');
        $twig = new \Twig_Environment($loader, [
            'cache' => false // ROOT . '/tmp'
        ]);

        $twig->addGlobal('baseUrl', BASEURL . '/');

        $this->twig = $twig;
    }

    public function isAuthenticated() {
        return isset($_SESSION['user']);
    }

    public function isAdmin() {
        return $this->isAuthenticated() && $_SESSION['user']->getRole() == 1;
    }

    public function redirect404() {
        header('HTTP/1.0 404 Not Found');
        exit();
    }
}
