<?php
require_once __DIR__ . '/../Model/artwork/artwork.php';
require_once __DIR__ . '/../Model/warehouse/warehouse.php';

$artworkModel = new Artwork($pdo);
$warehouseModel = new Warehouse($pdo);

$artworks = $artworkModel->getAllArtworks();
$warehouses = $warehouseModel->getAllWarehouses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oselo Gallery</title>
    <link rel="stylesheet" href="assets/style.css">
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

    <form action="../Controllers/controllerWh/warehouseController.php" method="post">
        <label for="id_artwork">Choose an artwork :</label>
        <select name="id_artwork" id="id_artwork" required>
            <?php foreach ($artworks as $artwork): ?>
                <option value="<?= $artwork['id_artwork']; ?>"><?= htmlspecialchars($artwork['artwork_title']); ?></option>
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

    <h3>Warehouses List</h3>
    <ul>
        <?php foreach ($warehouses as $warehouse): ?>
            <table>
                <tr>
                    <th>Warehouse</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Dimension</th>
                </tr>
                <tr>
                <td><?= htmlspecialchars($warehouse['warehouse_name'] ?? "Nom inconnu"); ?></td>
                <td><?= htmlspecialchars($artwork_title['artwork_title'] ?? "Nom inconnu"); ?></td>
                <td><?= htmlspecialchars($artist_name['artist_name'] ?? "Nom inconnu"); ?></td>
                <td><?= htmlspecialchars($production_year['production_year'] ?? "Nom inconnu"); ?></td>
                <td><?= htmlspecialchars($dimension['dimension'] ?? "Nom inconnu"); ?></td>
                </tr>
                
            </table>
        <?php endforeach; ?>
    </ul>
</body>
</html>
