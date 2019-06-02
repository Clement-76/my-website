<?php

namespace App\Controller;

use App\Model\UserManager;

class UsersController extends AppController {
    /**
     * displays the form to login and if the form
     * has been submitted checks the data and login the user
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function login() {

        // if the user is already connect
        if (isset($_SESSION['user'])) {
            header('Location: '. BASEURL . '/admin');
            exit();
        }

        // if the login form was submit
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
            $userManager = new UserManager();
            $user = $userManager->getUser($_POST['pseudo']);
            $errors = $user == false ? true : false;

            if (!$errors && password_verify($_POST['password'], $user->getPassword())) {
                $_SESSION['user'] = $user;
                header('Location: '. BASEURL . '/admin');
                exit();
            } else {
                $errors = true;
            }
        }

        echo $this->twig->render('login.twig', compact('errors', 'pageTitle'));
    }

    /**
     * logout the user by destroying session variables
     */
    public function logout() {
        $_SESSION = [];
        session_destroy();

        header('Location: '. BASEURL . '/login');
        exit();
    }
}
