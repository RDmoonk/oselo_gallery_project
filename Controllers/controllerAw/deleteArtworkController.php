<?php
require_once __DIR__ . '/../../Model/artwork/artwork.php';
require_once __DIR__ . '/../../Manager/config/database.php';

$artwork = new Artwork($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $artwork->deleteArtwork($_POST['id']);
    var_dump($_POST);
    header('Location: ../Views/index.php?deleted=3');
    exit;
} else {
    echo "Erreur : ID not found of wrong method.";
}
