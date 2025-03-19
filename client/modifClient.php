<?php
require '../db.php';

if (isset($_GET['codecli'])) {
    $codecli = $_GET['codecli'];

    $stmt = $pdo->prepare("SELECT * FROM CLIENT WHERE codecli = ?");
    $stmt->execute([$codecli]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        die("Client introuvable !");
    }
} else {
    die("Code client non fourni !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $sexe = $_POST['sexe'];
    $quartier = $_POST['quartier'];
    $niveau = $_POST['niveau'];
    $mail = $_POST['mail'];

    $stmt = $pdo->prepare("UPDATE CLIENT SET nom = ?, sexe = ?, quartier = ?, niveau = ?, mail = ? WHERE codecli = ?");
    if ($stmt->execute([$nom, $sexe, $quartier, $niveau, $mail, $codecli])) {
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
    <title>Modification Client</title>
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
        <img src="../img/jirama_logo.webp" alt="logo">
        <span>jirama</span>
    </figure>
    <h2>Modifier Client</h2>
    <form action="" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>

        <label for="sexe">Sexe :</label>
        <input type="text" name="sexe" value="<?= htmlspecialchars($client['sexe']) ?>" required>

        <label for="quartier">Quartier :</label>
        <input type="text" name="quartier" value="<?= htmlspecialchars($client['quartier']) ?>" required>

        <label for="niveau">Niveau :</label>
        <input type="text" name="niveau" value="<?= htmlspecialchars($client['niveau']) ?>" required>

        <label for="mail">Mail :</label>
        <input type="text" name="mail" value="<?= htmlspecialchars($client['mail']) ?>" required>

        <button type="submit">Mettre a jour</button>
    </form>
</body>
</html>
