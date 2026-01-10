<?php
namespace App\Controllers;

use Core\Controller;

class SportifController extends Controller {
    public function index() {
        $data = [
            'user_role' => 'sportif'
        ];
        $this->render('sportif/dashboard.twig', $data);
    }
}
