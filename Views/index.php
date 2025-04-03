<?php
require_once __DIR__ . '/../Model/artwork/artwork.php';
require_once __DIR__ . '/../Model/warehouse/warehouse.php';

$artworkModel = new Artwork($pdo);
$warehouseModel = new Warehouse($pdo);

$artworks = $artworkModel->getAllArtworks();
$warehouses = $warehouseModel->getAllWarehouses();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Artworks</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h2>Add an artwork to a warehouse</h2>

    <?php if (isset($_GET['success'])): ?>
        <p style="color:green;">sucess add !</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color:red;">Adding Error.</p>
    <?php endif; ?>

    <form action="../controllers/WarehouseController.php" method="post">
        <label for="id_artwork">Choose an artwork :</label>
        <select name="id_artwork" id="id_artwork" required>
            <?php foreach ($artworks as $artwork): ?>
                <option value="<?= $artwork['id_artwork']; ?>"><?= htmlspecialchars($artwork['artwork_name']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="id_warehouse">Choose a Warehouse :</label>
        <select name="id_warehouse" id="id_warehouse" required>
            <?php foreach ($warehouses as $warehouse): ?>
                <option value="<?= $warehouse['id_warehouse']; ?>"><?= htmlspecialchars($warehouse['warehouse_name']); ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add</button>
    </form>

    <h3>Warehouses list</h3>
    <ul>
        <?php foreach ($warehouses as $warehouse): ?>
            <li><?= htmlspecialchars($warehouse['warehouse_name']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
