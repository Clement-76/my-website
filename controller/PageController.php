<?php

namespace App\Controller;

class PageController extends AppController {

    public function displayLegalNotice() {
        echo $this->twig->render('pages/legal-notice.twig');
    }
}
