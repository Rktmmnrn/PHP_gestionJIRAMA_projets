<?php
include '../db.php';

if (isset($_GET['codecli'])) {
    $codecli = $_GET['codecli'];
} else {
    echo "Référence du client introuvable...";
}

try {
    $stmt = $pdo->prepare("SELECT COMPTEUR.pu, RELEVE_ELEC.valeur1 
                        FROM COMPTEUR 
                        JOIN RELEVE_ELEC ON COMPTEUR.codecompteur=RELEVE_ELEC.codecompteur WHERE codecli= ?;");
    $stmt->execute([$codecli]);

    $fact = $stmt->fetch(PDO::FETCH_ASSOC);

    // variable pour le montant
    $pu = $fact['pu'];
    $val1 = $fact['valeur1'];
    $somme = $pu*$val1;
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idpaye = $_POST['idpaye'];
    $datepaie = $_POST['datepaie'];
    $montant = $_POST['montant'];

    $stmt = $pdo->prepare("SELECT * FROM PAYER WHERE idpaye=?");
    $stmt-> execute([$idpaye]);

    if ($stmt-> rowCount() > 0) {
        echo "Ce facture est déjà présents.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO PAYER (idpaye, codecli, datepaie, montant) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$idpaye, $codecli, $datepaie, $montant])) {
            echo "Facture ajouté avec succès !";
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
  <title>Ajouter_Factures</title>
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
    form div {
        display: flex;
        align-items: center;
        gap: 5px;
    }
  </style>
</head>
<body>
    <h2>Facturation du client</h2>
    <form action="" method="POST">
        <label for="idpaye">Identification du facture :</label>
        <input type="text" name="idpaye" placeholder="PAY***" required>

        <label>code client :</label>
        <input type="text" name="codecli" value="<?=htmlspecialchars($codecli)?>" disabled="disabled" required>
        
        <label>Date de payement :</label>
        <input type="date" name="datepaie" id="" required>

        <label>Montant à payer :</label>
        <div>
            <input type="text" name="montant" value="<?=htmlspecialchars($somme)?>" disabled="disabled" required>Ar
        </div>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>