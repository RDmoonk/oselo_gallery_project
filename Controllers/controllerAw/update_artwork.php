<?php
require_once __DIR__ . '/../../Model/artwork/artwork.php';
require_once __DIR__ . '/../../Manager/config/database.php';

$artworkModel = new Artwork($pdo);

if (!isset($_GET['id'])) {
    die('ID not found');
}

$id = $_GET['id'];
$artwork = $pdo->prepare("SELECT * FROM artworks WHERE id_artwork = ?");
$artwork->execute([$id]);
$data = $artwork->fetch(PDO::FETCH_ASSOC);

if (!$data) die("Artwork not found");
?>

<form action="/oselogalleryproject/Controllers/controllerAw/update_artwork_process.php" method="post">
    <input type="hidden" name="id_artwork" value="<?= $data['id_artwork'] ?>">

    <label>Title:</label>
    <input type="text" name="artwork_title" value="<?= htmlspecialchars($data['artwork_title']) ?>"><br>

    <label>Artist:</label>
    <input type="text" name="artist_name" value="<?= htmlspecialchars($data['artist_name']) ?>"><br>

    <label>Year:</label>
    <input type="date" name="production_year" value="<?= htmlspecialchars($data['production_year']) ?>"><br>

    <label>Dimension:</label>
    <input type="text" name="dimension" value="<?= htmlspecialchars($data['dimension']) ?>"><br>

    <button type="submit">Update</button>
</form>
