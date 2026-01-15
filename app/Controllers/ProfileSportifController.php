<?php

namespace App\Controllers;
use Core\Controller;
use \App\Middleware\AuthMiddleware;
use App\Services\SportifServices;

class ProfileSportifController extends Controller {
    public function showProfile() {
        session_start();
        $user_role = $_SESSION['user_role'] ;

        $sportifService = new SportifServices();
        $sportif = $sportifService->getInfoClientById($_SESSION['user_id']);

        AuthMiddleware::handleSportif();
        $this->render('sportif/profile.twig', [
            'user_role' => $user_role ,
            'sportif' => $sportif
            ]);
    }
}