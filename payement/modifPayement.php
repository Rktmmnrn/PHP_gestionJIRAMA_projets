<?php
require '../db.php';

if (isset($_GET['idpaye'])) {
    $idP = $_GET['idpaye'];

    $stmt = $pdo->prepare("SELECT * FROM PAYER WHERE idpaye = ?");
    $stmt->execute([$idP]);
    $fact = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$fact) {
        die("Facture introuvable !");
    }
} else {
    die("Code facture non fourni !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codecli = $_POST['codecli'];
    $date = $_POST['datepaie'];
    $montant = $_POST['montant'];

    $stmt = $pdo->prepare("UPDATE PAYER SET codecli = ?, datepaie = ?, montant = ? WHERE idpaye = ?");
    if ($stmt->execute([$codecli, $date, $montant, $idP])) {
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
    <title>Modification_Facture</title>
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
    <h2>Modifier Facture</h2>
    <form action="" method="POST">        
        <label for="idpaye">Identification facture :</label>
        <input type="text" name="idpaye" value="<?= htmlspecialchars($idP) ?>" placeholder="PAY..." disabled="disabled" required>

        <label for="codecli">Code Client :</label>
        <input type="text" name="codecli" value="<?= htmlspecialchars($fact['codecli']) ?>" required>

        <label for="datepaie">date du payement :</label>
        <input type="date" name="datepaie" value="<?= htmlspecialchars($fact['datepaie']) ?>" id="">

        <label for="montant">Montant :</label>
        <input type="text" name="montant" value="<?= htmlspecialchars($fact['montant']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
