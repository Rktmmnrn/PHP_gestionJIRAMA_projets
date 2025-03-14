<?php
include("../../db.php");

$stmt = $pdo->query("SELECT * FROM RELEVE_ELEC");
$relElec = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste_relever_Elec</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 10px;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h2>Liste relever ELECTRICITÉ</h2>
    <!-- <a href="ajoutRelEau.php">Ajouter</a> -->
    <table>
        <tr>
            <th>code Electricité</th>
            <th>compteur</th>
            <th>valeur</th>
            <th>date relever</th>
            <th>date presentation</th>
            <th>date limite de paie</th>
        </tr>

        <?php foreach ($relElec as $relElec): ?>
            <tr>
                <td><?= htmlspecialchars($relElec['codeElec']) ?></td>
                <td><?= htmlspecialchars($relElec['codecompteur']) ?></td>
                <td><?= htmlspecialchars($relElec['valeur1']) ?> Kwh</td>
                <td><?= htmlspecialchars($relElec['date_relevé']) ?></td>
                <td><?= htmlspecialchars($relElec['date_présentation']) ?></td>
                <td><?= htmlspecialchars($relElec['date_limite_paie']) ?></td>
                <td>
                    <a href="modifRelElec.php?codeElec=<?= $relElec['codeElec'] ?>">Modifier</a>
                    <a href="supprRelElec.php?codeElec=<?= $relElec['codeElec'] ?>" onclick="return confirm('Supprimer le le relever : <?=htmlspecialchars($relElec['codeElec'])?>')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
