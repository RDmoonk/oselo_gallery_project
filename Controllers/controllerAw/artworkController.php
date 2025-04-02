<?php 

require_once __DIR__ . '/../../Model/artwork/artwork.php';

$artwork = new Artwork($pdo);

if($_SERVER["REQUEST_METHOD"]=== "POST"){
    $id_artwork = $_POST['id_artwork'];
}

