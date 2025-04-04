<?php
 require_once __DIR__ . '/../../Manager/config/database.php';
class Warehouse {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllWarehouses() {
        $stmt = $this->pdo->query("SELECT * FROM warehouse");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWarehouseWithArtworks() {
        $sql = "SELECT w.warehouse_name, w.id_warehouse, a.*
                FROM warehouse w
                LEFT JOIN artworks a ON w.id_warehouse = a.id_warehouse
                ORDER BY w.warehouse_name";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addArtworkToWarehouse($id_artwork, $id_warehouse) {
        $stmt = $this->pdo->prepare("UPDATE artworks SET id_warehouse = :id_warehouse WHERE id_artwork = :id_artwork");
        return $stmt->execute([
            'id_artwork' => $id_artwork,
            'id_warehouse' => $id_warehouse
        ]);
    }
}
