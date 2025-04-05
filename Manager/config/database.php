<?php 

$host = "localhost";
$dbname = "oselogaldb";
$username = "root";
$password ="";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username,$password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e){
    die("Connection error : " . $e->getMessage());
}

// all of this is needed to create a connection beteween the php and the database

