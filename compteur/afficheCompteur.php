<?php
include("../db.php");

$stmt = $pdo->query("SELECT * FROM COMPTEUR");
$compt = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['codecompteur'])) {
    $codecompt = $_GET['codecompteur'];

    $stmt = $pdo->prepare("DELETE FROM COMPTEUR WHERE codecompteur = ?");
    if ($stmt->execute([$codecompt])) {
        echo "<p style='color:green;'>Compteur supprimé avec succès.</p>";
    } else {
        echo "<p style='color:red;'>Erreur lors de la suppression.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des compteurs</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            list-style-type: none;
            text-decoration: none;
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
        table td img {
            width: 20px;
            height: 20px;
        }
        table td:last-child {
            border: none;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 30px;
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
                        <a href="modifCompteur.php?codecompteur=<?= $compt['codecompteur'] ?>"><img src="../img/settings-svgrepo-com (1).svg" alt="modif"></a>
                        <a href="afficheCompteur.php?codecompteur=<?= $compt['codecompteur'] ?>" onclick="return confirm('Supprimer le compteur : <?=htmlspecialchars($compt['codecompteur'])?>')">🗑</a>
                        <a href="<?php if($compt['type']=='Eau') {echo '../relever/eau/ajoutRelEau.php';} else if($compt['type']=='Electricité') {echo '../relever/elec/ajoutRelElec.php';} else {echo '../Error.php';} ?>?codecompteur=<?= $compt['codecompteur'] ?>">Relever</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>

</body>
</html>
