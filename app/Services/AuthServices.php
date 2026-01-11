<?php

namespace App\Services;
use App\Models\User;
use App\Models\Sportif;
use App\Repository\UserRepository;
use App\Repository\CoachRepository;
use App\Repository\SportifRepository;
use Exception;

class AuthServices {

    private UserRepository $userRepository;
    private CoachRepository $coachRepository; 
    private SportifRepository $sportifRepository;
 
    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->coachRepository = new CoachRepository();
        $this->sportifRepository = new SportifRepository();
    }

    public function registerUser(array $data , ?array $coachData = null, ?array $sportifData = null): bool {
        try {
            $user = new User(
                null,
                $data['nom'],
                $data['prenom'],
                $data['email'],
                password_hash($data['password'], PASSWORD_BCRYPT),
                (int)$data['role']
            );

            $this->userRepository->createUser($user);

            if ($data['role'] == 2 && $coachData !== null) { 
                $coach = new \App\Models\Coach(
                    null,
                    $coachData['biographie'],
                    $coachData['photo'],
                    (int)$coachData['annees_experience'],
                    $coachData['certification']
                );
                return $this->coachRepository->createCoach($coach);
            } elseif ($data['role'] == 1 && $sportifData !== null) { 
                $formData = array_merge($data, $sportifData);
                $sportif = Sportif::createFromArray($formData);

                return $this->sportifRepository->createSportif($sportif);
            }

            return true;
        } catch (Exception $e) {
            throw new Exception("Registration failed: " . $e->getMessage());
        }

    }
}