<?php 

require_once __DIR__ . '/../../Model/warehouse/warehouse.php';

$warehouse = new Warehouse($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $id_artwork = $_POST['id_artwork'];
    //$_POST will pass data to the on going script
    $id_warehouse = $_POST['id_warehouse'];

    if($warehouse->addArtworkToWarehouse($id_artwork, $id_warehouse)) {
        header("Location: success.php");
        exit;
        //will redirect to the file
        
    } else {
        echo "Error during the adding.";
        // if possible, it would be better to make a pop up for the error
    }
    // this if else will take add a new warehouse
    
}
