<?php

namespace App\Repository;

use Repository\UserRepository;
use App\Models\User;
use App\Models\Sportif;
use Config\Database;
use PDO;
use PDOException;

class SportifRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createSportif(Sportif $sportif): bool {
        try {
            $userId = (int)$this->db->lastInsertId();

            $stmt = $this->db->prepare("INSERT INTO client (id_client, telephone) 
                                        VALUES (:id_client, :telephone)");
            $stmt->bindValue(':id_client', $userId);
            $stmt->bindValue(':telephone', $sportif->getNumeroTelephone());
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la création du sportif: " . $e->getMessage());
        }
    }

    public function getInfoClientById(int $id_client) {
        $stmt = $this->db->prepare("SELECT * FROM users u inner join client c on c.id_client = u.id WHERE u.id = :id_client");
        $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($data);
        if ($data) {
            return new Sportif(
                $data['id'],
                $data['nom'],
                $data['prenom'],
                $data['email'],
                $data['password'],
                $data['id_role'],
                $data['id_client'],
                $data['telephone']
            );
        }
    }
    public function UpdateSportif(Sportif $sportif , $id): bool {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("UPDATE users u SET nom = :nom, prenom = :prenom, email = :email, password = :password
                                            WHERE u.id = :id;");
                                            
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':nom', $sportif->getFirstName());
            $stmt->bindValue(':prenom', $sportif->getLastName());
            $stmt->bindValue(':email', $sportif->getEmail());
            $stmt->bindValue(':password', $sportif->getPasswordHash());
             $stmt->execute();

            $stmt2 = $this->db->prepare("UPDATE client SET telephone = :telephone WHERE id_client = :id_client");
            $stmt2->bindValue(':id_client', $id, PDO::PARAM_INT);
            $stmt2->bindValue(':telephone', $sportif->getNumeroTelephone());
            $stmt2->execute();

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new \Exception("Erreur lors de la mise à jour du sportif: " . $e->getMessage());
        }

    }
}