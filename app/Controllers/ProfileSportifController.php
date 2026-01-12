<?php

namespace App\Controllers;
use Core\Controller;
use \App\Middleware\AuthMiddleware;

class ProfileSportifController extends Controller {
    public function showProfile() {
        session_start();
        $user_role = $_SESSION['user_role'] ;

        AuthMiddleware::handleSportif();
        $this->render('sportif/profile.twig', ['user_role' => $user_role]);
    }
}