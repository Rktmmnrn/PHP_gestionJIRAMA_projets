<?php
include '../db.php';

if (isset($_GET['codecli'])) {
    $codeC = $_GET['codecli'];
} else {
    echo "Référence du client introuvable...";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codecompt = $_POST['codecompteur'];
    $type = $_POST['type'];
    $pu = $_POST['pu'];

    $stmt = $pdo->prepare("SELECT * FROM COMPTEUR WHERE codecompteur=?");
    $stmt-> execute([$codecompt]);

    if ($stmt-> rowCount() > 0) {
        echo "Ce compteur est déjà présents.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO COMPTEUR (codecompteur, type, pu, codecli) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$codecompt, $type, $pu, $codeC])) {
            echo "Compteur ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout...";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter_Compteurs</title>
</head>
<body>
<h2>Ajouter un Compteur</h2>
    <form action="" method="POST">
        <label for="codecompteur">Code Compteur :</label>
        <input type="text" name="codecompteur" required placeholder="CPT***">

        <label>type :</label>
        <select name="type">
            <option value="Electricite">Electricite</option>
            <option value="Eau">Eau</option>
        </select><br>
        
        <label>Prix Unitaire :</label>
        <input type="text" name="pu" required>

        <label>Code Client :</label>
        <input type="text" name="codecli" value="<?=htmlspecialchars($codeC) ?>" disabled="disabled">

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>