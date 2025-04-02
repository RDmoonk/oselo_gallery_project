<?php 

require_once __DIR__ . '/../../Manager/config/database.php';

class Artwork {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    // ça sert à quoi

    public function allArtworks(){
        $stmt = $this->pdo->query("SELECT * FROM artworks");
        return $stmt->fetchAll();
        // stmt sert à 
    }
}