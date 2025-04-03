<?php
 require_once __DIR__ . '/../../Manager/config/database.php';

class Warehouse {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addArtworkToWarehouse($id_artwork, $id_warehouse) {
        $stmt = $this->pdo->prepare("INSERT INTO warehouse (id_artwork, id_warehouse) VALUES (:id_artwork, :id_warehouse)");
        return $stmt->execute([
            'id_artwork' => $id_artwork,
            'id_warehouse' => $id_warehouse
        ]);
    }

    public function getAllWarehouses() {
        $stmt = $this->pdo->query("SELECT * FROM warehouse");
        return $stmt->fetchAll();
    }
}
?>


