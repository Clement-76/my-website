<?php

namespace App\Controller;

class HomeController extends AppController {
    public function displayHome() {
        echo $this->twig->render('home.twig');
    }
}
