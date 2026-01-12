<?php
namespace App\Controllers;

use Core\Controller;
use \App\Middleware\AuthMiddleware;

class CoachController extends Controller {
    public function index() {
        session_start();
        $user_role = $_SESSION['user_role'] ;
        AuthMiddleware::handleCoach();

        $this->render('coach/dashboard.twig' , ['user_role' => $user_role]);
    }

}
