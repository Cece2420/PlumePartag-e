<?php
$host = 'localhost';
$dbname = 'plume';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;port=8889;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>