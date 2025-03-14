<?php
require '../../db.php';

if (isset($_GET['codeEau'])) {
    $codeE = $_GET['codeEau'];

    $stmt = $pdo->prepare("DELETE FROM RELEVE_EAU WHERE codeEau = ?");
    if ($stmt->execute([$codeE])) {
        echo "Relever supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "Code relever non fourni.";
}
