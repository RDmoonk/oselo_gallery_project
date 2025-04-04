<?php
require_once __DIR__ . '/../Model/artwork/artwork.php';
require_once __DIR__ . '/../Model/warehouse/warehouse.php';

$artworkModel = new Artwork($pdo);
$warehouseModel = new Warehouse($pdo);

$artworks = $artworkModel->getAllArtworks();
$warehouses = $warehouseModel->getAllWarehouses();


$warehouseMap = [];
foreach ($warehouses as $warehouse) {
    $warehouseMap[$warehouse['id_warehouse']] = [
        'name' => $warehouse['warehouse_name'],
        'address' => $warehouse['warehouse_address']
    ];
    // Create a mapping of warehouse ID to warehouse details for easier lookup
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oselo Gallery</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>Oselo Gallery</h1>
    </header>

    <h2>Give an artwork to a warehouse</h2>

    <?php if (isset($_GET['success'])): ?>
        <p style="color:green;">Success add!</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color:red;">Adding Error.</p>
    <?php endif; ?>

    <form action="../Controllers/controllerWh/warehouseController.php" method="post">
        <label for="id_artwork">Choose an artwork:</label>
        <select name="id_artwork" id="id_artwork" required>
            <?php foreach ($artworks as $artwork): ?>
                <option value="<?= $artwork['id_artwork']; ?>"><?= htmlspecialchars($artwork['artwork_title']); ?></option>
            <?php endforeach; ?>
        </select>
        <a href="add_artwork.php">
            <button type="button">Add artwork</button>
        </a>

        <label for="id_warehouse">Choose a Warehouse:</label>
        <select name="id_warehouse" id="id_warehouse" required>
        <?php foreach ($warehouses as $warehouse): ?>
            <option value="<?= $warehouse['id_warehouse']; ?>">
                <?= htmlspecialchars($warehouse['warehouse_name']); ?>
            </option>
        <?php endforeach; ?>
        </select>
        <a href="add_warehouse.php">
            <button type="button">Add a warehouse</button>
        </a>

        <button type="submit">Add to the warehouse</button>
    </form>

    <h3>Warehouses List</h3>
    <table>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Year</th>
            <th>Dimension</th>
            <th>Warehouse</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($artworks as $artwork): ?>
            <tr>
                <td><?= htmlspecialchars($artwork['artwork_title']) ?></td>
                <td><?= htmlspecialchars($artwork['artist_name']) ?></td>
                <td><?= htmlspecialchars($artwork['production_year']) ?></td>
                <td><?= htmlspecialchars($artwork['dimension']) ?></td>
                <td>
                    <?php 
                        
                        $warehouseDetails = $warehouseMap[$artwork['id_warehouse']] ?? null;
                        if ($warehouseDetails) {
                            echo htmlspecialchars($warehouseDetails['name']) . " (" . htmlspecialchars($warehouseDetails['address']) . ")";
                        } else {
                            echo "No warehouse found";
                        }
                        // Get the warehouse details based on the artwork's warehouse ID
                    ?>
                </td>
                <td>
                    <form action="/../../Controllers/controllerAw/update_artwork.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $artwork['id_artwork'] ?>">
                        <button type="submit">Modify</button>
                    </form>
                    <form action="/../../Controllers/controllerAw/delete_artwork.php" method="post" style="display:inline;" onsubmit="return confirm('Delete this artwork ?');">
                        <input type="hidden" name="id" value="<?= $artwork['id_artwork'] ?>">
                        <button type="submit" style="color:red;">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
