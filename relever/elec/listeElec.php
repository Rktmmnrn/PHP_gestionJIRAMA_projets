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
        table td:last-child {
            display: flex;
            align-items: center;
            gap: 20px;
            border: none;
        }
        table a:first-child img {
            width: 25px;
            height: 25px;
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
        a {
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <figure>
        <img src="../../img/electricity-svgrepo-com (1).svg" alt="logo">
    </figure>
    <div>
        <h2>Liste relever ELECTRICITÉ</h2>
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
                        <a href="modifRelElec.php?codeElec=<?= $relElec['codeElec'] ?>"><img src="../../img/settings-svgrepo-com (1).svg" alt="modif"></a>
                        <a href="supprRelElec.php?codeElec=<?= $relElec['codeElec'] ?>" onclick="return confirm('Supprimer le le relever : <?=htmlspecialchars($relElec['codeElec'])?>')">🗑</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <a href="../../index.php">revenir</a>

</body>
</html>
