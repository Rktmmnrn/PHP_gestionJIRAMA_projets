<?php
require '../../db.php';

if (isset($_GET['codeEau'])) {
    $codeEau = $_GET['codeEau'];

    $stmt = $pdo->prepare("SELECT * FROM RELEVE_EAU WHERE codeEau = ?");
    $stmt->execute([$codeEau]);
    $relEau = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$relEau) {
        die("Relever introuvable !");
    }
} else {
    die("Code relever non fourni !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $compteur = $_POST['compteur'];
    $val = $_POST['val'];
    $relever = $_POST['relever'];
    $presentation = $_POST['presentation'];
    $limite = $_POST['limite'];

    $stmt = $pdo->prepare("UPDATE RELEVE_EAU SET codecompteur= ?, valeur2= ?, date_relevé2= ?, date_présentation2= ?, date_limite_paie2= ? WHERE codeEau = ?");
    if ($stmt->execute([$compteur, $val, $relever, $presentation, $limite, $codeEau])) {
        echo "Mise à jour réussie !";
    } else {
        echo "Erreur de mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Relever Eau</title>
    <style>

    </style>
</head>
<body>
    <h2>Modifier le Relever</h2>
    <form action="" method="POST">
        <label for="compteur">Compteur :</label>
        <input type="text" name="compteur" value="<?= htmlspecialchars($relEau['codecompteur']) ?>" placeholder="CPT***" required>

        <label for="val">valeurs :</label>
        <input type="text" name="val" value="<?= htmlspecialchars($relEau['valeur2']) ?>" required>m³

        <label for="relever">date relever :</label>
        <input type="date" name="relever" value="<?= htmlspecialchars($relEau['date_relevé2']) ?>" required>

        <label for="presentation">date présentation :</label>
        <input type="date" name="presentation" value="<?= htmlspecialchars($relEau['date_présentation2']) ?>" required>

        <label for="limite">date limite :</label>
        <input type="date" name="limite" value="<?= htmlspecialchars($relEau['date_limite_paie2']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
