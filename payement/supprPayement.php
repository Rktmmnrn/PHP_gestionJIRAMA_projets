<?php
require '../db.php';

if (isset($_GET['idpaye'])) {
    $idP = $_GET['idpaye'];

    $stmt = $pdo->prepare("DELETE FROM PAYER WHERE idpaye = ?");
    if ($stmt->execute([$idP])) {
        echo "Compteur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "Code compteur non fourni.";
}
