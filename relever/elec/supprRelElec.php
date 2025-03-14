<?php
require '../../db.php';

if (isset($_GET['codeElec'])) {
    $codeE = $_GET['codeElec'];

    $stmt = $pdo->prepare("DELETE FROM RELEVE_ELEC WHERE codeElec = ?");
    if ($stmt->execute([$codeE])) {
        echo "Relever supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "Code relever non fourni.";
}
