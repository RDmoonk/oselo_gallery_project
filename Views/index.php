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
    <style>
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
</style>
    
</head>
<body>
    <header>
        <h1>Oselo Gallery</h1>
    </header>

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
                <option value="<?= $warehouse['id_warehouse']; ?>"><?= htmlspecialchars($artwork['artwork_name'] ?? "Nom inconnu");; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add</button>
    </form>

    <h3>Warehouses List</h3>
    <ul>
        <?php foreach ($warehouses as $warehouse): ?>
            <li><?= htmlspecialchars($artwork['artwork_name'] ?? "Nom inconnu");; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
