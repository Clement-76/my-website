<?php

namespace App\Controller;

use App\Entity\Message;
use App\Services\JSON;
use App\Services\Mailer;

class ContactController extends AppController {

    /**
     * send an email to the admin and echo in json the response
     */
    public function sendMessage() {
        header('Content-type: application/json; charset=utf-8');

        if (!isset($_POST['name'], $_POST['email'], $_POST['object'], $_POST['message'])) {
            echo JSON::JSONResponse('error', 'Des champs ne sont pas remplis');
            exit();
        }

        $message = new Message([
            'author' => $_POST['name'],
            'email' => $_POST['email'],
            'object' => $_POST['object'],
            'content' => $_POST['message']
        ]);

        if (!$message->isValid()) {
            echo JSON::JSONResponse('error', 'Formulaire invalide');
            exit();
        }

        $mailer = new Mailer();
        $success = $mailer->sendEmail($message, 'clement.patigny@gmail.com', [
            'name' => 'Clément PATIGNY',
            'email' => 'clement-contact@webagency-project.ovh',
        ]);

        if ($success) {
            echo JSON::JSONResponse('success');
        } else {
            echo JSON::JSONResponse('error', 'Une erreur est survenue l\'envoi de l\'email, merci de réessayer');
        }
    }
}
