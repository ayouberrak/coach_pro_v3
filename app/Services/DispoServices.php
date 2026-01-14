<?php

namespace App\Services;
use App\Repository\DispoRepository;
use Exception;

class DispoServices {

    private DispoRepository $dispoRepository;

    public function __construct() {
        $this->dispoRepository = new DispoRepository();
    }

    public function getAllDispo($id_coach) {
        try {
            return $this->dispoRepository->getDispoByCoachId($id_coach);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve disponibilities: " . $e->getMessage());
        }
    }
}