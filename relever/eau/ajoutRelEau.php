<?php
include '../../db.php';

if (isset($_GET['codecompteur'])) {
    $codeC = $_GET['codecompteur'];
} else {
    echo "Référence du compteur introuvable...";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codeEau = $_POST['codeEau'];
    $valeur = $_POST['valeur2'];
    $relever = $_POST['date_relever2'];
    $presentation = $_POST['date_presentation2'];
    $limite = $_POST['date_limite_paie2'];

    $stmt = $pdo->prepare("SELECT * FROM RELEVE_EAU WHERE codeEau=?");
    $stmt-> execute([$codeEau]);

    if ($stmt-> rowCount() > 0) {
        echo "Ce relever est déjà présents.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO RELEVE_EAU (codeEau, codecompteur, valeur2, date_relevé2, date_présentation2, date_limite_paie2) VALUES (?, ?, ?, ?, ?, ?);");
        if ($stmt->execute([$codeEau, $codeC, $valeur, $relever, $presentation, $limite])) {
            echo "Relever ajouté avec succès !";
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
  <title>Ajouter_RelEau</title>
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
  </style>
</head>
<body>
    <h2>Ajouter un relever Eau</h2>
    <form action="" method="POST">
        <label for="codeEau">Code Eau :</label>
        <input type="text" name="codeEau" required placeholder="E***">

        <label>Compteur :</label>
        <input type="text" name="codecompteur" value="<?=htmlspecialchars($codeC) ?>" required placeholder="CPT***" disabled="disabled">
        
        <label>valeur :</label>
        <input type="text" name="valeur2" required>

        <label>date relever :</label>
        <input type="date" name="date_relever2">

        <label>date présentation :</label>
        <input type="date" name="date_presentation2">

        <label>date limite payement :</label>
        <input type="date" name="date_limite_paie2">

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>