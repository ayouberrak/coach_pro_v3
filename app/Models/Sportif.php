<?php
namespace App\Models;

class Sportif extends User {

    private ?int $id_sportif;
    private string $numero_telephone;

    public function __construct(?int $id = null, string $firstName = "", string $lastName = "", string $email = "", string $passwordHash = "", int $role = 1,
                                ?int $id_sportif = null, string $numero_telephone) {
        parent::__construct($id, $firstName, $lastName, $email, $passwordHash, $role);
        $this->id_sportif = $id_sportif;
        $this->numero_telephone = $numero_telephone;
    }
    public function getIdSportif(): int {
        return $this->id_sportif;
    }
    public function getNumeroTelephone(): string {
        return $this->numero_telephone;
    }
    public function setNumeroTelephone(string $numero_telephone): void {
        $this->numero_telephone = $numero_telephone;
    }

    public static function createFromArray(array $data): Sportif {
        return new Sportif(
            $data['id'] ?? null,
            $data['firstName'] ?? '',
            $data['lastName'] ?? '',
            $data['email'] ?? '',
            $data['passwordHash'] ?? '',
            $data['role'] ?? 1,
            $data['id_sportif'] ?? null,
            $data['numero_telephone'] ?? ''
        );
    }
}
