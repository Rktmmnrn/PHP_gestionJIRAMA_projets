<?php
include '../../db.php';

if (isset($_GET['codecompteur'])) {
    $codeC = $_GET['codecompteur'];
} else {
    echo "Référence du compteur introuvable...";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codeElec = $_POST['codeElec'];
    $valeur = $_POST['valeur1'];
    $relever = $_POST['date_relever'];
    $presentation = $_POST['date_presentation'];
    $limite = $_POST['date_limite_paie'];

    $stmt = $pdo->prepare("SELECT * FROM RELEVE_ELEC WHERE codeElec=?");
    $stmt-> execute([$codeElec]);

    if ($stmt-> rowCount() > 0) {
        echo "Ce relever est déjà présents.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO RELEVE_ELEC (codeElec, codecompteur, valeur1, date_relevé, date_présentation, date_limite_paie) VALUES (?, ?, ?, ?, ?, ?);");
        if ($stmt->execute([$codeElec, $codeC, $valeur, $relever, $presentation, $limite])) {
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
  <title>Ajouter_RelElec</title>
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
    <h2>Ajouter un relever Electricite</h2>
    <form action="" method="POST">
        <label for="codeElec">Code Electricité :</label>
        <input type="text" name="codeElec" required placeholder="C***">

        <label>Compteur :</label>
        <input type="text" name="codecompteur" value="<?=htmlspecialchars($codeC) ?>" required placeholder="CPT***" disabled="disabled">
        
        <label>valeur :</label>
        <input type="text" name="valeur1" required>

        <label>date relever :</label>
        <input type="date" name="date_relever">

        <label>date présentation :</label>
        <input type="date" name="date_presentation">

        <label>date limite payement :</label>
        <input type="date" name="date_limite_paie">

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>