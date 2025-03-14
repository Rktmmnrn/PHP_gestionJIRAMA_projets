<?php
require '../db.php';

if (isset($_GET['codecompteur'])) {
    $codecompt = $_GET['codecompteur'];

    $stmt = $pdo->prepare("DELETE FROM COMPTEUR WHERE codecompteur = ?");
    if ($stmt->execute([$codecompt])) {
        echo "Compteur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "Code compteur non fourni.";
}
