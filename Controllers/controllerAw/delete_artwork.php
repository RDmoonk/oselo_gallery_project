<?php

require_once __DIR__ . '/../Manager/config/database.php';
require_once __DIR__ . '/../../Model/artwork/artwork.php';

// if the id is passed by GET 
if (isset($_GET['id'])) {
    // Get the id that need to be deleted
    $id_artwork = $_GET['id'];
    

    $artworkModel = new Artwork($pdo);

    
    try {
        $artworkModel->deleteArtwork($id_artwork);  // Appel à la méthode de suppression
        // Redirection avec succès après suppression
        header('Location: ../Views/index.php?deleted=1');
        exit;
        // try to delete the artwrok with a call methode of suppression and then redirect with sucess after the delete
    } catch (Exception $e) {

        header('Location: ../Views/index.php?error=1');
        exit;
    }
} else {
    //if the ID didn't pass
    echo "Error : ID not specify.";
}

