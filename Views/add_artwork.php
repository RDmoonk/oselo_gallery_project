<?php
require_once __DIR__ . '/../Manager/config/database.php'; 
// // Database connection for the warehouse creation


$artwork_title = $artist_name = $production_year = $dimension = "";
$success = $error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artwork_title = trim($_POST["artwork_title"] ?? '');
    $artist_name = trim($_POST["artist_name"] ?? '');
    $production_year = trim($_POST["production_year"] ?? '');
    $dimension = trim($_POST["dimension"] ?? '');


    if (!empty($artwork_title) && !empty($production_year) && !empty($dimension)) {
        try {
            
            $sql = "INSERT INTO artworks (artwork_title, artist_name, production_year, dimension) VALUES (?, ?, ?,?)";
            $stmt = $pdo->prepare($sql);
            //this is the SQL request 

            
            if ($stmt->execute([$artwork_title,$artist_name ,$production_year, $dimension])) $success = "L'œuvre a été ajoutée avec succès !";
             else $error = "Error during the artwork adding.";

            // execute the SQL request 
        } catch (PDOException $e) {
            $error = "SQL Error : " . $e->getMessage();
        }
    } else {
        $error = "Please complete the area.";
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
        <label for="artwork_title">Artwork :</label>
        <input type="text" name="artwork_title" value="<?= htmlspecialchars($artwork_title); ?>" required>

        <label for="artist_name">Artist:</label>
        <input type="text" name="artist_name" value="<?= htmlspecialchars($artist_name); ?>" required>

        <label for="production_year">Year of production :</label>
        <input type="date" name="production_year" value="<?= htmlspecialchars($production_year); ?>" required>

        <label for="dimension">Dimensions :</label>
        <input type="text" name="dimension" value="<?= htmlspecialchars($dimension); ?>" required>

        <button type="submit">Add</button>
    </form>
</body>
</html>
