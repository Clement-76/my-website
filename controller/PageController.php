<?php

namespace App\Controller;

class PageController extends AppController {

    public function displayLegalNotice() {
        echo $this->twig->render('legal-notice.twig');
    }
}
