<?php
require '../../db.php';

if (isset($_GET['codeElec'])) {
    $codeElec = $_GET['codeElec'];

    $stmt = $pdo->prepare("SELECT * FROM RELEVE_ELEC WHERE codeElec = ?");
    $stmt->execute([$codeElec]);
    $relElec = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$relElec) {
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

    $stmt = $pdo->prepare("UPDATE RELEVE_ELEC SET codecompteur= ?, valeur1= ?, date_relevé= ?, date_présentation= ?, date_limite_paie= ? WHERE codeElec = ?");
    if ($stmt->execute([$compteur, $val, $relever, $presentation, $limite, $codeElec])) {
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
    <title>Modification Relever Elec</title>
  <style>
    * {
        margin: 0;
        padding: 0;
        text-decoration: none;
    }
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 10px;
    }
    form {
        display: flex;
        flex-direction: column;
        box-shadow: 0px 0px 10px 3px gray;
        padding: 20px;
        gap: 10px;
        background-color: rgb(255,255,255,0.85);
    }
    form select,input {
        padding: 5px;
    }
    form button {
        text-transform: capitalize;
        border-radius: 10px;
        border: 1px solid gray;
        font-weight: bold;
        padding: 10px;
        font-size: 16px;
    }
    form button:hover {
        color: white;
        background-color: green;
        transition: ease 200ms;
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
    figure span {
        text-transform: uppercase;
        color: #e76610;
        font-weight: bold;
        font-size: 62px;
    }
  </style>
</head>
<body>
    <figure>
        <img src="../../img/jirama_logo.webp" alt="logo">
        <span>jirama</span>
    </figure>
    <h2>Modifier le Relever</h2>
    <form action="" method="POST">
        <label for="compteur">Compteur :</label>
        <input type="text" name="compteur" value="<?= htmlspecialchars($relElec['codecompteur']) ?>" placeholder="CPT***" required>

        <label for="val">valeurs :</label>
        <input type="text" name="val" value="<?= htmlspecialchars($relElec['valeur1']) ?>" required>Kwh

        <label for="relever">date relever :</label>
        <input type="date" name="relever" value="<?= htmlspecialchars($relElec['date_relevé']) ?>" required>

        <label for="presentation">date présentation :</label>
        <input type="date" name="presentation" value="<?= htmlspecialchars($relElec['date_présentation']) ?>" required>

        <label for="limite">date limite :</label>
        <input type="date" name="limite" value="<?= htmlspecialchars($relElec['date_limite_paie']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
