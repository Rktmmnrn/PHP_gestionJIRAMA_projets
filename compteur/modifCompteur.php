<?php
require '../db.php';

if (isset($_GET['codecompteur'])) {
    $codecompt = $_GET['codecompteur'];

    $stmt = $pdo->prepare("SELECT * FROM COMPTEUR WHERE codecompteur = ?");
    $stmt->execute([$codecompt]);
    $compt = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$compt) {
        die("Compteur introuvable !");
    }
} else {
    die("Code compteur non fourni !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $pu = $_POST['pu'];
    $codecli = $_POST['codecli'];

    $stmt = $pdo->prepare("UPDATE COMPTEUR SET type = ?, pu = ?, codecli = ? WHERE codecompteur = ?");
    if (($stmt->execute([$type, $pu, $codecli, $codecompt]))&&($type==('Eau'||'Electricite'))) {
        echo "Mise à jour réussie !";
    } else {
        echo "Erreur de mise à jour.".$type."doit être 'Eau' ou 'Electricité'";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification list compteurs</title>
    <style>

    </style>
</head>
<body>
    <h2>Modifier liste Compteurs</h2>
    <form action="" method="POST">        
        <label for="type">Type :</label>
        <input type="text" name="type" value="<?= htmlspecialchars($compt['type']) ?>" placeholder="'Eau' ou 'Electricité'" required>

        <label for="pu">prix unitaire :</label>
        <input type="text" name="pu" value="<?= htmlspecialchars($compt['pu']) ?>" required>

        <label for="codecli">code du client :</label>
        <input type="text" name="codecli" value="<?= htmlspecialchars($compt['codecli']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
