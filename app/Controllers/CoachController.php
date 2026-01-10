<?php
namespace App\Controllers;

use Core\Controller;

class CoachController extends Controller {
    public function index() {
        $data = [
            'user_role' => 'coach',
            'stats' => [
                'active_clients' => 12,
                'today_sessions' => 4,
                'monthly_revenue' => '4.5k'
            ],
            'upcoming_sessions' => [
                ['client_name' => 'Ahmet Yildiz', 'type' => 'Crossfit', 'date' => '10 Jan, 14:00', 'status' => 'Confirmé', 'status_class' => 'pending'],
                ['client_name' => 'Sarah Connor', 'type' => 'Yoga', 'date' => '10 Jan, 16:00', 'status' => 'En cours', 'status_class' => 'active']
            ]
        ];
        $this->render('coach/dashboard.twig', $data);
    }
}
