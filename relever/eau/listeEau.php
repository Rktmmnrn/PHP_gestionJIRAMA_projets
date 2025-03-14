<?php
include("../../db.php");

$stmt = $pdo->query("SELECT * FROM RELEVE_EAU");
$relEau = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste_relever_eau</title>
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
    <h2>Liste relever EAU</h2>
    <!-- <a href="ajoutRelEau.php">Ajouter</a> -->
    <table>
        <tr>
            <th>code Eau</th>
            <th>compteur</th>
            <th>valeur</th>
            <th>date relever</th>
            <th>date presentation</th>
            <th>date limite de paie</th>
        </tr>

        <?php foreach ($relEau as $relEau): ?>
            <tr>
                <td><?= htmlspecialchars($relEau['codeEau']) ?></td>
                <td><?= htmlspecialchars($relEau['codecompteur']) ?></td>
                <td><?= htmlspecialchars($relEau['valeur2']) ?> m³</td>
                <td><?= htmlspecialchars($relEau['date_relevé2']) ?></td>
                <td><?= htmlspecialchars($relEau['date_présentation2']) ?></td>
                <td><?= htmlspecialchars($relEau['date_limite_paie2']) ?></td>
                <td>
                    <a href="modifRelEau.php?codeEau=<?= $relEau['codeEau'] ?>">Modifier</a>
                    <a href="supprRelEau.php?codeEau=<?= $relEau['codeEau'] ?>" onclick="return confirm('Supprimer le le relever : <?=htmlspecialchars($relEau['codeEau'])?>')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
