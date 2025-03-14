<?php
$host = "localhost";
$dbname = "gestion_payementJIRAMA";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='position:absolute;top:0;right:0;'>bd oke</p>";
} catch (PDOException $e) {
    die("Erreur de connexion :" . $e->getMessage());
}