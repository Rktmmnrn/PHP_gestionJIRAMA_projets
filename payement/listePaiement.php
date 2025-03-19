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
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px 60px;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        header figure {
            width: 120px;
            height: 120px;
            align-items: center;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        header figure img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        header figure img:hover {
            scale: 1.1;
            transition: ease 200ms;
        }
        header figure span {
            text-transform: uppercase;
            color: #e76610;
            font-weight: bold;
            font-size: 20px;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }
        table {
            width: 100%;
        }
        table td {
            padding: 10px;
            border: 1px solid gray;
        }
        table td:last-child {
            border: none;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 30px;
        }
        table a:first-child img {
            width: 25px;
            height: 25px;
        }
    </style>
</head>
<body>
    <header>
        <figure>
            <img src="../img/jirama_logo.webp" alt="logo">
            <span>jirama</span>
        </figure>
        <nav>
            <a href="../index.php">revenir</a>
        </nav>
    </header>
    <main>
        <h2>Liste des Paiements</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Client</th>
                <th>IdClient</th>
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
                        <a href="modifPayement.php?idpaye=<?= $paiement['idpaye'] ?>"><img src="../img/settings-svgrepo-com (1).svg" alt="modif"></a>
                        <a href="supprPayement.php?idpaye=<?= $paiement['idpaye'] ?>" onclick="return confirm('Supprimer la facture n° : <?=$paiement['idpaye']?>');">🗑</a>
                        <a href="facturationPdf.php?idpaye=<?= $paiement['idpaye'] ?>" target="_blank">📄 PDF</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
