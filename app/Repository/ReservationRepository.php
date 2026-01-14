<?php

namespace App\Repository;

use Config\Database;
use PDO;
use App\Models\Reservation;
use Exception;

class ReservationRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createReservation(Reservation $reservation): bool {
        try {
            $stmt = $this->db->prepare("INSERT INTO reservation (id_seance, id_sportif, date_reservation) VALUES (:id_seance, :id_sportif, :date_reservation)");
            $stmt->bindValue(':id_seance', $reservation->getIdSeance(), PDO::PARAM_INT);
            $stmt->bindValue(':id_sportif', $reservation->getIdSportif(), PDO::PARAM_INT);
            $stmt->bindValue(':date_reservation', $reservation->getDateReservation(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la création de la réservation: " . $e->getMessage());
        }
    }


}