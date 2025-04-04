<?php
require_once __DIR__ . '/../../Model/artwork/artwork.php';
require_once __DIR__ . '/../../Manager/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE artworks SET artwork_title = ?, artist_name = ?, production_year = ?, dimension = ? WHERE id_artwork = ?");
    $stmt->execute([
        $_POST['artwork_title'],
        $_POST['artist_name'],
        $_POST['production_year'],
        $_POST['dimension'],
        $_POST['id_artwork']
    ]);

    // some redirection errors were made
    header("Location: /oselogalleryproject/Views/index.php?updated");
    exit;
    
}
