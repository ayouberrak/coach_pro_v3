<?php

namespace App\Repository;

use Config\Database;

class RoleRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllRole() {
        $stmt = $this->db->prepare("SELECT * FROM role");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}