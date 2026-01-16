<?php
namespace App\Controllers;

use Core\Controller;
use \App\Middleware\AuthMiddleware;
use App\Services\ReservationServices;

class CoachController extends Controller {
    public function dashboard() {
        session_start();
        $user_role = $_SESSION['user_role'] ;
        AuthMiddleware::handleCoach();

        $resServices = new ReservationServices();
        $reservations = $resServices->getReservationEnattenteByIdCoach($_SESSION['user_id']);

        // print_r($reservations);
        $this->render('coach/dashboard.twig' , ['user_role' => $user_role, 'reservations' => $reservations]);
    }

    



}
