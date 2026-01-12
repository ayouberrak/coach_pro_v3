<?php
namespace App\Controllers;
use \App\Services\CoachServices;
use Core\Controller;
use \App\Middleware\AuthMiddleware;

class CoachsController extends Controller {
    public function index() {
        session_start();
        $user_role = $_SESSION['user_role'] ;
        AuthMiddleware::handleSportif();

        $coachService = new CoachServices();
        $coaches = $coachService->getAllCoach();

        $this->render('sportif/coaches.twig' , [
                        'user_role' => $user_role,
                        'coaches' => $coaches
                    ]);
    }

}