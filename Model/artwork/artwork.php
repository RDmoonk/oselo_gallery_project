<?php 

require_once __DIR__ . '/../../Manager/config/database.php';

class Artwork {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    // this is needed to connect the database to the php class

    public function getAllArtworks(){
        $stmt = $this->pdo->query("SELECT * FROM artworks");
        return $stmt->fetchAll();
        // stmt is needed for executing a request that was prepared
        
    }
    public function deleteArtwork($id) {
        $stmt = $this->pdo->prepare("DELETE FROM artworks WHERE id_artwork = ?");
        return $stmt->execute([$id]);}
        //public function that will let the button delete do it work

    
}
