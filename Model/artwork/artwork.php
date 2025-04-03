<?php 

require_once __DIR__ . '/../../Manager/config/database.php';

class Artwork {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    // is needed for ...

    public function getAllArtworks(){
        $stmt = $this->pdo->query("SELECT * FROM artwork");
        return $stmt->fetchAll();
        // stmt is needed for ..., no query pls
    }
}