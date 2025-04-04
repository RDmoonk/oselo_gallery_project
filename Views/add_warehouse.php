<?php
require_once __DIR__ . '../../Manager/config/database.php'; // connecting to the database

// variables initialisation
$warehouse_name = $warehouse_address = "";
$success = $error = "";

// form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $warehouse_name = trim($_POST["warehouse_name"] ?? '');
    $warehouse_address = trim($_POST["warehouse_address"] ?? '');

    if (!empty($warehouse_name) && !empty($warehouse_address)) {
        try {
            // SQL request
            $sql = "INSERT INTO warehouse (warehouse_name, warehouse_address) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);

            // request executation
            if ($stmt->execute([$warehouse_name, $warehouse_address])) {
                $success = "L'entrepôt a été ajouté avec succès !";
            } else {
                $error = "Erreur lors de l'ajout de l'entrepôt.";
            }
        } catch (PDOException $e) {
            $error = "Erreur SQL : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a warehouse</title>
    <link rel="stylesheet" href="assets/styles.css"> <!-- Lien vers le CSS -->
</head>
<body>
    <div class="container">
        <h2>New warehouse</h2>

        <!-- error or sucess messages -->
        <?php if ($success): ?>
            <p style="color:green; text-align:center;"><?= htmlspecialchars($success); ?></p>
        <?php elseif ($error): ?>
            <p style="color:red; text-align:center;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Form that is used form the name and adresss of the warehouse -->
        <form action="" method="post">
            <label for="warehouse_name">Warehouse name :</label>
            <input type="text" name="warehouse_name" value="<?= htmlspecialchars($warehouse_name); ?>" required>

            <label for="warehouse_address">Address :</label>
            <input type="text" name="warehouse_address" value="<?= htmlspecialchars($warehouse_address); ?>" required>

            <button type="submit">Add</button>
        </form>
    </div>
</body>
</html>
