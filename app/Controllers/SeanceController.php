<?php
namespace App\Controllers;

use \App\Middleware\AuthMiddleware;
use Core\Controller;

class SeanceController extends Controller {
    public function index() {
        session_start();
        $user_role = $_SESSION['user_role'] ;
        AuthMiddleware::handleSportif();
        $this->render('sportif/seances.twig', ['user_role' => $user_role]);
    }
}
