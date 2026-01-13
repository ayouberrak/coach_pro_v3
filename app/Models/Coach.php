<?php
namespace App\Models;

class Coach extends User {
    private ?int $idCoach;

    private string $biographie;
    private string $photo;
    private int $anneeExperience;
    private string $certefications;

    

    public function __construct(?int $id = null, string $firstName  = '', string $lastName = '', string $email = '', string $passwordHash = '', int $role = 2,
                                ?int $idCoach = null, string $biographie , string $photo , int $anneeExperience, string $certefications ) {
        parent::__construct($id, $firstName, $lastName, $email, $passwordHash, $role);
        $this->idCoach = $idCoach;
        $this->biographie = $biographie;
        $this->photo = $photo;
        $this->anneeExperience = $anneeExperience;
        $this->certefications = $certefications;
    }
    public function getIdCoach(): ?int {
        return $this->idCoach;
    }
    public function getBiographie(): string {
        return $this->biographie;
    }
    public function getPhoto(){
        return $this->photo;
    }
    public function getPhotoPath(): string
    {
        return $this->photo
            ? '/coachPro_v3/public/uploads/' . $this->photo
            : '/coachPro_v3/public/uploads/default.jpg';
    }

    public function getAnneeExperience(): int {
        return $this->anneeExperience;
    }
    public function getCertefications(): string {
        return $this->certefications;
    }
    public function setBiographie(string $biographie): void {
        $this->biographie = $biographie;
    }
    public function setPhoto(string $photo): void {
        $this->photo = $photo;
    }
    public function setAnneeExperience(int $anneeExperience): void {
        $this->anneeExperience = $anneeExperience;
    }
    public function setCertefications(string $certefications): void {
        $this->certefications = $certefications;
    }

    public static function createFromArrayC(array $data): Coach {
        return new Coach(
            $data['id'],
            $data['nom'],
            $data['prenom'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['role'] ?? 2,
            $data['id_coach'] ?? null,
            $data['biographie'] ?? '',
            $data['photo'] ?? '',
            $data['anneeExperience'] ?? 0,
            $data['certefications'] ?? ''
        );
    }
}
