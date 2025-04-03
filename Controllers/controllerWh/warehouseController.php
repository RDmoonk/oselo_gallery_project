<?php 

require_once __DIR__ . '/../../Model/warehouse/warehouse.php';

$warehouse = new Warehouse($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id_artwork']) && isset($_POST['id_warehouse'])) {
        $id_artwork = $_POST['id_artwork'];
        $id_warehouse = $_POST['id_warehouse'];

        if ($warehouse->addArtworkToWarehouse($id_artwork, $id_warehouse)) {
            header("Location:  ../../Views/index.php?sucess=1");
            //  ../../views/index.php?success=1
            exit;
        } else {
            header("Location: ../../Views/index.php?error=1");
            exit;
        }
    } else {
        echo "Error : One of the zone of the form is missing.";
    }
} else {
    echo "Access Denied.";
}
