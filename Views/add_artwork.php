<?php
require_once __DIR__ . '/../Manager/config/database.php';

// fetch all the already existing warehouses
$warehouses = $pdo->query("SELECT * FROM warehouse")->fetchAll(PDO::FETCH_ASSOC);

$artwork_name = $production_year = $dimension = "";
$id_warehouse = null;
$success = $error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artwork_name = trim($_POST["artwork_title"] ?? '');
    $artist_name = trim($_POST["artist_name"] ?? '');
    $production_year = trim($_POST["production_year"] ?? '');
    $dimension = trim($_POST["dimension"] ?? '');
    $id_warehouse = $_POST["id_warehouse"] ?? null;

    if ($artwork_name && $production_year && $dimension) {
        try {
            $sql = "INSERT INTO artworks (artwork_title, artist_name, production_year, dimension, id_warehouse) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$artwork_name, $artist_name, $production_year, $dimension, $id_warehouse ?: null]);
            $success = "Artwork has been added.";
        } catch (PDOException $e) {
            $error = "SQL Error : " . $e->getMessage();
        }
    } else {
        $error = "All areas are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/artworkStyle.css">
    <title>Artwork</title>
</head>
<body>
    <h2>Add an Artwork</h2>

   
    <?php if (!empty($success)): ?>
        <p style="color:green;"><?= htmlspecialchars($success); ?></p>
    <?php elseif (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <!-- This code is used for the messages: One for the error message and the other one for the success one -->

    <form action="" method="post">
    <label>Artwork :</label>
    <input type="text" name="artwork_title" required><br>

    <label>Artist :</label>
    <input type="text" name="artist_name" required><br>

    <label>Years of productions :</label>
    <input type="date" name="production_year" required><br>

    <label>Dimensions :</label>
    <input type="text" name="dimension" required><br>

    <label>Warehouse :</label>
    <select name="id_warehouse">
        <option value="">Choose a warehouse</option>
        <?php foreach ($warehouses as $wh): ?>
            <option value="<?= $wh['id_warehouse'] ?>">
                <?= htmlspecialchars($wh['warehouse_name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Add</button>
</form>
</body>
</html>
