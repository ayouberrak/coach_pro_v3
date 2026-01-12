<?php
namespace App\Controllers;

use Core\Controller;

class ReservationController extends Controller {
    public function index() {
        session_start();
        \App\Middleware\AuthMiddleware::handleCoach();
         $user_role = $_SESSION['user_role'] ;

        $this->render('coach/reservations.twig', ['user_role' => $user_role]);
    }
}
