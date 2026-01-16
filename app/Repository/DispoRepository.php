<?php

namespace App\Repository;

use Config\Database;
use  App\Models\Disponabilite;
use PDO;
use Exception;

class DispoRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getDispoByCoachId(int $coachId): array {
        try {
            $stmt = $this->db->prepare("SELECT * FROM disponible WHERE id_coach = :id_coach");
            $stmt->bindValue(':id_coach', $coachId, PDO::PARAM_INT);
            $stmt->execute();
            $disposData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dispos = [];
            foreach ($disposData as $data) {
                $dispos[] = new Disponabilite(
                    $data['id_dispo'],
                    $data['id_coach'],
                    $data['jour'],
                    $data['heures_debut'],
                    $data['heures_fin']
                );
            }
            return $dispos;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des disponibilités: " . $e->getMessage());
        }
    }


    public function create(Disponabilite $dispo): bool {
        try {
            $stmt = $this->db->prepare("INSERT INTO disponible (id_coach, jour, heures_debut, heures_fin) VALUES (:id_coach, :jour, :heures_debut, :heures_fin)");
            $stmt->bindValue(':id_coach', $dispo->getIdCoach(), PDO::PARAM_INT);
            $stmt->bindValue(':jour', $dispo->getDateDispo(), PDO::PARAM_STR);
            $stmt->bindValue(':heures_debut', $dispo->getHeureDebut(), PDO::PARAM_STR);
            $stmt->bindValue(':heures_fin', $dispo->getHeureFin(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la création de la disponibilité: " . $e->getMessage());
        }
    }

}