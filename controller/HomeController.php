<?php

namespace App\Controller;

class HomeController extends AppController {
    public function displayHome() {
        $pageTitle = 'Clément Patigny';
        echo $this->twig->render('home.twig', compact('pageTitle'));
    }
}
