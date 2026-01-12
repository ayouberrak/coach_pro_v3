<?php
namespace App\Controllers;

use Core\Controller;

class SportifController extends Controller {
    public function index() {
        session_start();
        \App\Middleware\AuthMiddleware::handleSportif();
        $this->render('sportif/dashboard.twig');
    }
}
