<?php


namespace App\Services;
use App\Repository\ReservationRepository;
use App\Models\Reservation;

use Exception;
class ReservationServices {

    private ReservationRepository $reservationRepository;

    public function __construct() {
        $this->reservationRepository = new ReservationRepository();
    }

    public function createReservation($data, int $id) {
        try {
            $data['id_coach'] = $id;
            $reservation = Reservation::arrayToReservation($data);
            return $this->reservationRepository->createReservation($reservation);
        } catch (Exception $e) {
            throw new Exception("Failed to create reservation: " . $e->getMessage());
        } 
    }
    public function getReservationsByClientId(int $clientId) {
        try {
            return $this->reservationRepository->getReservationsEnAttenteByIdClient($clientId);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve reservations: " . $e->getMessage());
        }
    }

    public function UpdateStatusOnTerminer(){
        try {
            return $this->reservationRepository->UpdateStatusOnTerminer();
        } catch (Exception $e) {
            throw new Exception("Failed to update reservation statuses: " . $e->getMessage());
        }
    }


    public function getReservationTerminerByClient(int $idClient) {
        try {
            return $this->reservationRepository->getReservationTerminerByClient($idClient);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve reservations: " . $e->getMessage());
        }
    }


    public function countResByClient(int $idClient) {
        try {
            return $this->reservationRepository->countResByClient($idClient);
        } catch (Exception $e) {
            throw new Exception("Failed to count reservations: " . $e->getMessage());
        }
    }

}