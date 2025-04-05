<?php
require_once __DIR__ .'/../Manager/config/database.php';


//Recovery of the artwork's list
$sql = "SELECT id_artwork, artwork_name, year_production, dimension FROM artworks";
$stmt = $pdo->query($sql);
$artworks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Œuvres</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h2>Liste des Œuvres</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Année</th>
            <th>Dimensions</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($artworks as $artwork): ?>
            <tr>
                <td><?= htmlspecialchars($artwork['id_artwork']); ?></td>
                <td><?= htmlspecialchars($artwork['artwork_name']); ?></td>
                <td><?= htmlspecialchars($artwork['year_production']); ?></td>
                <td><?= htmlspecialchars($artwork['dimension']); ?></td>
                <td>
                    <form action="delete_artwork.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette œuvre ?');">
                        <input type="hidden" name="id_artwork" value="<?= $artwork['id_artwork']; ?>">
                        <button type="submit" style="background-color: red; color: white;">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
