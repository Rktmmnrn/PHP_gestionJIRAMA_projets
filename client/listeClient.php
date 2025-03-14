<?php
require_once '../db.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sortByQuartier = isset($_GET['quartier']);
$opt = isset($_GET['filtre']);

if (!empty($search)) {
    $stmt = $pdo->prepare("SELECT * FROM CLIENT WHERE nom LIKE :search OR codecli OR mail LIKE :search");
    $stmt->execute(['search' => "%$search%"]);
} else if (isset($_GET['quartier']) && !empty($_GET['quartier'])) {
    $quartier = $_GET['quartier'];
    $stmt = $pdo->prepare("SELECT * FROM CLIENT WHERE quartier = :quartier");
    $stmt->execute(['quartier' => $quartier]);
}
// else if ($sortByQuartier) {
//     $stmt = $pdo->query("SELECT * FROM CLIENT ORDER BY quartier");
// }
else {
    $stmt = $pdo->query("SELECT * FROM CLIENT ORDER BY nom");
}

echo $opt;

$cli = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listes Clients</title>
    <style>
        * {
            text-decoration: none;
        }
        a {
            color: black;
            border-radius: 5px;
            padding: 5px;
            border: 1px solid;
        }
        table {
            width: 100%;
            border: 1px solid black;
        }
        table a:first-child {
            color: blue;
        }
        table a:nth-child(2) {
            color: red;
            margin: 0 10px;
        }
        table td {
            padding: 10px;
            border: 1px solid gray;
        }
        table td:last-child {
            border: none;
        }
    </style>
</head>
<body>
    <a href="ajoutClient.php">ajouter un client</a>
    <h2>Liste des clients</h2>
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Rechercher un CLIENT" value="<?=htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
        <label for="quartier">Choisir un quartier :</label>
        <input type="text" name="quartier" id="quartier" placeholder="Nom du quartier">
        <button type="submit">Filtrer</button>
        <select name="filtre" id="" onchange="this.form.submit()">
            <option value="nom">nom</option>
            <option value="quartiers">quartiers</option>
        </select>
    </form>
    <table>
        <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Sexe</th>
            <th>Quartier</th>
            <th>Niveau</th>
            <th>Email</th>
        </tr>
        <?php foreach ($cli as $cli): ?>
        <tr>
            <td><?= htmlspecialchars($cli['codecli']) ?></td>
            <td><?= htmlspecialchars($cli['nom']) ?></td>
            <td><?= htmlspecialchars($cli['sexe']) ?></td>
            <td><?= htmlspecialchars($cli['quartier']) ?></td>
            <td><?= htmlspecialchars($cli['niveau']) ?></td>
            <td><?= htmlspecialchars($cli['mail']) ?></td>
            <td>
                <a href="modifClient.php?codecli=<?= $cli['codecli'] ?>" onclick="return confirm('Modifier ce client !')">Modifier</a>
                <a href="supprClient.php?codecli=<?= $cli['codecli'] ?>" onclick="return confirm('Confirmer la suppression du client : <?= htmlspecialchars($cli['codecli'])?> ?');">Supprimer</a>
                <a href="../payement/historiquePayement.php?codecli=<?= $cli['codecli'] ?>" target="_blank">Voir Factures</a>
                <a href="../compteur/ajoutCompteur.php?codecli=<?= $cli['codecli'] ?>" target="_blank">Ajout Compteur</a>
                <a href="../payement/ajoutFacture.php?codecli=<?= $cli['codecli'] ?>">Facturer !</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table><br>
    <a href="../compteur/afficheCompteur.php" target="_blank">Compteur</a>
    <!-- <script src="../js/client.js"></script> -->
</body>
</html>
