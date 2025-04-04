<?php
require_once __DIR__ . '/../Manager/config/database.php'; // Connexion à la base de données

// Initialisation des variables
$artwork_title = $artist_name = $production_year = $dimension = "";
$success = $error = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artwork_title = trim($_POST["artwork_title"] ?? '');
    $artist_name = trim($_POST["artist_name"] ?? '');
    $production_year = trim($_POST["production_year"] ?? '');
    $dimension = trim($_POST["dimension"] ?? '');


    if (!empty($artwork_title) && !empty($production_year) && !empty($dimension)) {
        try {
            // Préparer la requête SQL
            $sql = "INSERT INTO artworks (artwork_title, artist_name, production_year, dimension) VALUES (?, ?, ?,?)";
            $stmt = $pdo->prepare($sql);

            // Exécuter la requête
            if ($stmt->execute([$artwork_title,$artist_name ,$production_year, $dimension])) {
                $success = "L'œuvre a été ajoutée avec succès !";
            } else {
                $error = "Erreur lors de l'ajout de l'œuvre.";
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Œuvre</title>
</head>
<body>
    <h2>Ajouter une Œuvre</h2>

    <!-- Message de succès ou d'erreur -->
    <?php if (!empty($success)): ?>
        <p style="color:green;"><?= htmlspecialchars($success); ?></p>
    <?php elseif (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="artwork_title">Artwork :</label>
        <input type="text" name="artwork_title" value="<?= htmlspecialchars($artwork_title); ?>" required>

        <label for="artist_name">Artist:</label>
        <input type="text" name="artist_name" value="<?= htmlspecialchars($artist_name); ?>" required>

        <label for="production_year">Année de production :</label>
        <input type="date" name="production_year" value="<?= htmlspecialchars($production_year); ?>" required>

        <label for="dimension">Dimensions :</label>
        <input type="text" name="dimension" value="<?= htmlspecialchars($dimension); ?>" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
