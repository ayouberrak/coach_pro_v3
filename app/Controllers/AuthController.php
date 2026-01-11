<?php
namespace App\Controllers;

use Core\Controller;
use Services\AuthServices;
use App\Services\RolesServices;


class AuthController extends Controller {
    
    public function login() {
        $this->render('auth/login.twig');
    }

    public function register() {
        $roleService = new RolesServices();
        $roles = $roleService->getAllRoles();
        $this->render('auth/register.twig', ['roles' => $roles]);
    }
}
