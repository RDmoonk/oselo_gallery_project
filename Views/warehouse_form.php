<?php 

require_once __DIR__ . '/../Manager/config/database.php';
require_once __DIR__ . '/../Model/artwork/artwork.php';
require_once __DIR__ . '/../Model/warehouse/warehouse.php';

$artworkModel = new Artwork($pdo);
$warehouseModel = new Warehouse($pdo);

// Récupération des données
$artworks = $artworkModel->getAllArtworks();
$warehouses = $warehouseModel->getAllWarehouses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oselo Gallery</title>
</head>
<body>
    <form action="../Controllers/controllerWh/warehouseController.php" method="post">
        <label for="id_artwork">Choose an artwork :</label>
        <select name="id_artwork" id="id_artwork">
            <?php foreach($artworks as $artwork): ?>
                <option 
                value="<?= $artwork['id_artwork']; ?>"<?=htmlspecialchars($artwork['artwork_name']); ?>
                    >
                </option>
                
            <?php endforeach ?>

        </select>

        <label for="id_warehouse">Choose a Warehouse :</label>
        <select name="id_warehouse" id="id_warehouse" require>
                <?php foreach ($warehouses as $warehouse): ?>
                    <option 
                        value="<?= $warehouse['id_warehouse']; ?>"<?=htmlspecialchars($warehouse['warehouse_name']); ?>
                    >
                </option>
                <?php endforeach ?>

        </select>

        <button type="submit">Add</button>

    </form>
    
</body>
</html>

