<?php
require '../db.php';

if (isset($_GET['codecli'])) {
    $codecli = $_GET['codecli'];

    $stmt = $pdo->prepare("DELETE FROM CLIENT WHERE codecli = ?");
    if ($stmt->execute([$codecli])) {
        echo "Client supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "Code client non fourni.";
}
