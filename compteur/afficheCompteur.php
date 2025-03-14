<?php
include("../db.php");

$stmt = $pdo->query("SELECT * FROM COMPTEUR");
$compt = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des compteurs</title>
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
    <h2>Liste des compteurs</h2>
    <table>
        <tr>
            <th>Codecompteur</th>
            <th>type</th>
            <th>pu</th>
            <th>codecli</th>
        </tr>

        <?php foreach ($compt as $compt): ?>
            <tr>
                <td><?= htmlspecialchars($compt['codecompteur']) ?></td>
                <td><?= htmlspecialchars($compt['type']) ?></td>
                <td><?= htmlspecialchars($compt['pu']) ?> Ar</td>
                <td><?= htmlspecialchars($compt['codecli']) ?></td>
                <td>
                    <a href="modifCompteur.php?codecompteur=<?= $compt['codecompteur'] ?>">Modifier</a>
                    <a href="supprCompteur.php?codecompteur=<?= $compt['codecompteur'] ?>" onclick="return confirm('Supprimer le compteur : <?=htmlspecialchars($compt['codecompteur'])?>')">Supprimer</a>
                    <a href="<?php if($compt['type']=='Eau') {echo '../relever/eau/ajoutRelEau.php';} else if($compt['type']=='Electricité') {echo '../relever/elec/ajoutRelElec.php';} else {echo '../Error.php';} ?>?codecompteur=<?= $compt['codecompteur'] ?>">Relever</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
