<?php

namespace App\Services;
use App\Repository\RoleRepository;
use Exception;
class RolesServices {

    private RoleRepository $roleRepository;

    public function __construct() {
        $this->roleRepository = new RoleRepository();
    }

    public function getAllRoles() {
        try {
            return $this->roleRepository->getAllRole();
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve roles: " . $e->getMessage());
        }
    }
}