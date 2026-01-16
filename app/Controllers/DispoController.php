<?php

namespace App\Controllers;
use Core\Controller;
use App\services\DispoServices;
use App\Middleware\AuthMiddleware;

class DispoController extends Controller {
    public function index() {
        session_start();
        AuthMiddleware::handleCoach();
         $user_role = $_SESSION['user_role'] ;

         $dispoService = new DispoServices();
         $disponibilities = $dispoService->getAllDispo($_SESSION['user_id']);

        $this->render('coach/disponibilities.twig', [
                 'user_role' => $user_role,
                 'disponibilities' => $disponibilities
            ]);
    }

    public function create($data) {
        session_start();
        AuthMiddleware::handleCoach();
         $user_role = $_SESSION['user_role'] ;
         $dispoService = new DispoServices();
            $dispoService->createDispo($data , $_SESSION['user_id']);

        $this->render('coach/disponibilities.twig', ['user_role' => $user_role]);
    }

}