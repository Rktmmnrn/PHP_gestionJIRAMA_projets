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
  <style>
    * {
        margin: 0;
        padding: 0;
        text-decoration: none;
    }
    body {
        display: flex;
        align-items: center;
        font-family: Arial, sans-serif;
        justify-content: space-evenly;
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
    div {
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
    }
    figure {
        height: 100vh;
    }
    figure img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
  </style>
</head>
<body>
    <figure>
        <img src="../img/pngtree-electric-meter-icon-energy-counter-png-image_5140107.png" alt="logo">
    </figure>
    <div>
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
    
            <button type="submit">ajouter</button>
        </form>
    </div>
</body>
</html>