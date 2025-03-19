<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codecli = $_POST['codecli'];
    $nom = $_POST['nom'];
    $sexe = $_POST['sexe'];
    $quartier = $_POST['quartier'];
    $niveau = $_POST['niveau'];
    $mail = $_POST['mail'];

    $stmt = $pdo->prepare("SELECT * FROM CLIENT WHERE codecli=?");
    $stmt-> execute([$codecli]);

    if ($stmt-> rowCount() > 0) {
        echo "Ce client est déjà présents.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO CLIENT (codecli, nom, sexe, quartier, niveau, mail) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$codecli, $nom, $sexe, $quartier, $niveau, $mail])) {
            echo "Client ajouté avec succès !";
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
  <title>Ajouter_Clients</title>
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
        display: flex;
        align-items: center;
    }
    figure img {
        width: 100%;
        height: 80%;
        object-fit: contain;
    }

  </style>
</head>
<body>
    <figure>
        <img src="../img/client-profile-svgrepo-com.svg" alt="logo">
    </figure>
    <div>
        <h2>Ajouter un Client</h2>
        <form action="" method="POST">
            <label for="codecli">Code Client :</label>
            <input type="text" name="codecli" required placeholder="CLI***">
    
            <label for="nom">Nom :</label>
            <input type="text" name="nom" required>
    
            <label>Sexe :</label>
            <select name="sexe">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select><br>
    
            <label>Quartier :</label>
            <input type="text" name="quartier" required>
    
            <label>Niveau :</label>
            <input type="text" name="niveau">
    
            <label>Email :</label>
            <input type="email" name="mail">
    
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>