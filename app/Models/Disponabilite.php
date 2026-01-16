<?php
namespace App\Models;

class Disponabilite {
    private ?int $id_dispo;

    private int $id_coach;

    private string $dateDispo;
    private string $heureDebut;
    private string $heureFin;

    public function __construct(?int $id_dispo = null, int $id_coach , string $dateDispo , string $heureDebut , string $heureFin ) {
        $this->id_dispo = $id_dispo;
        $this->id_coach = $id_coach;
        $this->dateDispo = $dateDispo;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
    }
    public function getIdDispo(): int {
        return $this->id_dispo;
    }
    public function getIdCoach(): int {
        return $this->id_coach;
    }
    public function getDateDispo(): string {
        return $this->dateDispo;
    }
    public function getHeureDebut(): string {
        return $this->heureDebut;
    }
    public function getHeureFin(): string {
        return $this->heureFin;
    }


    public static function arrayToDisponabilite(array $data , int $id): Disponabilite {
        return new Disponabilite(
            $data['id_dispo'] ?? null,
            $id,
            $data['jour'],
            $data['debut'],
            $data['fin']
        );
    }
}