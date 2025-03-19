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
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgb(255,255,255,0.8);
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        table a:first-child img {
            width: 25px;
            height: 25px;
        }
        table td:last-child {
            display: flex;
            align-items: center;
            gap: 20px;
            border: none;
        }
        figure {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            z-index: -1;
        }
        figure img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        h2 {
            color: white;
        }
        a {
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <figure>
        <img src="../../img/water-conservancy-svgrepo-com.svg" alt="logo">
    </figure>
    <h2>Liste relever EAU</h2>
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
                    <a href="modifRelEau.php?codeEau=<?= $relEau['codeEau'] ?>"><img src="../../img/settings-svgrepo-com (1).svg" alt="modif"></a>
                    <a href="supprRelEau.php?codeEau=<?= $relEau['codeEau'] ?>" onclick="return confirm('Supprimer le le relever : <?=htmlspecialchars($relEau['codeEau'])?>')">🗑</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="../../index.php">revenir</a>

</body>
</html>
