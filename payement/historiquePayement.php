<?php
require '../db.php';

if (isset($_GET['codecli'])) {
    $codecli = $_GET['codecli'];

    $sql = "SELECT * FROM PAYER WHERE codecli = ? ORDER BY datepaie DESC LIMIT 3";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codecli]);
    $factures = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt_total = $pdo->prepare("SELECT SUM(montant) FROM PAYER WHERE codecli = ?");
    $stmt_total->execute([$codecli]);
    $total_montant = $stmt_total->fetch(PDO::FETCH_ASSOC);
} else echo "Rien...";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/historique.css">
    <title>Historique des 3 dernières factures</title>
</head>
<body>
    <h2>Historique des 3 dernières factures du client <?=htmlspecialchars($codecli) ?></h2>

    <?php if (!empty($factures)): ?>
        <table>
            <tr>
                <th>ID Facture</th>
                <th>Date</th>
                <th>Montant</th>
            </tr>
            <?php foreach ($factures as $factures): ?>
                <tr>
                    <td><?= $factures['idpaye'] ?></td>
                    <td><?= $factures['datepaie'] ?></td>
                    <td><?= number_format($factures['montant'], 2, ',', ' ') ?> Ar</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($total_montant as $total_montant): ?>
                <tr>
                    <td colspan='3'>montant totaux: <?= number_format($total_montant,2,',',' ')?> Ar</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucune facture trouvée pour ce client.</p>
    <?php endif; ?>
</body>
</html>
