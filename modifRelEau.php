<?php
require '../../db.php';

if (isset($_GET['codeEau'])) {
    $idEau = $_GET['codeEau'];

    $stmt = $pdo->prepare("SELECT * FROM RELEVE_EAU WHERE codeEau = ?");
    $stmt->execute([$idEau]);
    $relever = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$relever) {
        die("Relever introuvable !");
    }
} else {
    die("Code relever non fourni !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codecompt = $_POST['codecompt'];
    $val = $_POST['val'];
    $rel = $_POST['relever'];
    $presentation = $_POST['presentation'];
    $limite = $_POST['limite'];   

    $stmt = $pdo->prepare("UPDATE RELEVE_EAU SET codecompteur = ?, valeur2 = ?, date_relevé2 = ?, date_présentation2 = ?, date_limite_paie2= ? WHERE codeEau = ?");
    if ($stmt->execute([$codecompt, $val, $rel, $presentation, $limite, $idEau])) {
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
    <title>Modification_ReleverEau</title>
    <style>
    </style>
</head>
<body>
    <h2>Modification du relever</h2>
    <form action="" method="POST">        
        <label for="codeEau">Identification relever Eau :</label>
        <input type="text" name="codeEau" value="<?= htmlspecialchars($idEau) ?>" placeholder="E***" disabled="disabled" required>

        <label for="codecompt">Code Compteur :</label>
        <input type="text" name="codecompt" value="<?= htmlspecialchars($relever['codecompteur']) ?>" required>

        <label for="val">valeur :</label>
        <input type="text" name="val" value="<?= htmlspecialchars($relever['valeur2']) ?> m³" id="">

        <label for="relever">date de relever :</label>
        <input type="date" name="relever" value="<?= htmlspecialchars($relever['date_relevé2']) ?>" required>

        <label for="presentation">date de presentation :</label>
        <input type="date" name="presentation" value="<?= htmlspecialchars($relever['date_présentation2']) ?>" required>

        <label for="limite">date limite payement :</label>
        <input type="date" name="limite" value="<?= htmlspecialchars($relever['date_limite_paie2']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
