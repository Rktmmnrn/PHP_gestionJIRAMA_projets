<?php
require '../db.php';

try {
    $stmt = $pdo->query("SELECT PAYER.idpaye, CLIENT.nom, CLIENT.codecli, PAYER.montant, PAYER.datepaie
                         FROM PAYER
                         JOIN CLIENT ON PAYER.codecli = CLIENT.codecli");

    $paiements = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $paiement[0]->nom;
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Paiements</title>
    <style>
        table {
            width: 100%;
            border: 1px solid black;
        }
        td {
            padding: 10px;
            border: 1px solid gray;
        }
    </style>
</head>
<body>
    <h2>Liste des Paiements</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Client</th>
            <th>IDClient</th>
            <th>Montant</th>
            <th>Date</th>
        </tr>
        <?php foreach ($paiements as $paiement): ?>
            <tr>
                <td><?= htmlspecialchars($paiement['idpaye']) ?></td>
                <td><?= htmlspecialchars($paiement['nom']) ?></td>
                <td><?= htmlspecialchars($paiement['codecli']) ?></td>
                <td><?= htmlspecialchars($paiement['montant']) ?> MGA</td>
                <td><?= htmlspecialchars($paiement['datepaie']) ?></td>
                <td>
                    <a href="modifPayement.php?idpaye=<?= $paiement['idpaye'] ?>">modifier</a>
                    <a href="supprPayement.php?idpaye=<?= $paiement['idpaye'] ?>" onclick="return confirm('Supprimer la facture n° : <?=$paiement['idpaye']?>');">supprimer</a>
                    <a href="facturationPdf.php?idpaye=<?= $paiement['idpaye'] ?>" target="_blank">📄 PDF</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
