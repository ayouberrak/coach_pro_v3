<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\CoachServices;
use App\Services\DispoServices;
use App\Services\SportServices;
class DetailsCoachController extends Controller {

        public function showCoaches($id) {
            $coachServices = new CoachServices();
            $coach = $coachServices->getCoachById($id);

            $dispoServices = new DispoServices();
            $disponibilities = $dispoServices->getAllDispo($id);
            $disopFroma = [];
            foreach ($disponibilities as $dispo) {
                $disopFroma[] = [
                    'date' => $dispo->getDateDispo(),
                    'heure' => date('H:i', strtotime($dispo->getHeureDebut())),
                ];
            }

            $sportServices = new SportServices();
            $sport = $sportServices->getSportByIdCoach($id);
            

            
            $this->render('sportif/detailsCoach.twig', [
                'coach' => $coach ,
                'disopFroma' => $disopFroma,
                'sport' => $sport
            ]);
    }
}