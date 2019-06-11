<?php

namespace App\Services;

use App\Entity\Message;

class Mailer {

    /**
     * Send a message to an email
     * @param Message $message
     * @param $recipient
     * @param array $admin an array which contains an email and name keys
     * @return bool
     * @throws \Exception if the email is invalid
     */
    public function sendEmail(Message $message, $recipient, array $admin) {

        if (filter_var($recipient, FILTER_VALIDATE_EMAIL) == false) {
            throw new \Exception('Invalid email $recipient parameter');
        }

        $name = $message->getAuthor();
        $email = $message->getEmail();

        $headers = 'From: "' . $admin['name'] . '" <' . $admin['email'] . '>' . "\r\n" .
            'Reply-To: "' . $name . '" <' . $email . '>' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html;  charset=utf-8'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $content = $message->getContent();
        $object = $message->getObject() . ' - ' . $name;

        $success = mail($recipient, $object, $content, $headers);
        return $success;
    }
}
