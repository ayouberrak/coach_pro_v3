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

        // print_r($sportif);

        AuthMiddleware::handleSportif();
        $this->render('sportif/profile.twig', [
            'user_role' => $user_role ,
            'sportif' => $sportif
            ]);
    }

    public function editProfile($data) {
        session_start();
        $user_role = $_SESSION['user_role'] ;

        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $sportifService = new SportifServices();
            $sportifService->updateClientInfo($data, $_SESSION['user_id']);
            header("Location: ".BASE_URL."/sportif/profile");
            exit();
        }

        AuthMiddleware::handleSportif();
    }
}