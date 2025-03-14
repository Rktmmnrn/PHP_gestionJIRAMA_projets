<?php
include '../db.php';

if (isset($_GET['codecli'])) {
    $codecli = $_GET['codecli'];
} else {
    echo "Référence du client introuvable...";
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
</head>
<body>
<h2>Facturation du client</h2>
    <form action="" method="POST">
        <label for="idpaye">Identification du facture :</label>
        <input type="text" name="idpaye" placeholder="PAY***" required>

        <label>code client :</label>
        <input type="text" name="codecli" value="<?=htmlspecialchars($codecli)?>" required>
        
        <label>Date de payement :</label>
        <input type="date" name="datepaie" id="" required>

        <label>Montant à payer :</label>
        <input type="text" name="montant" required>Ar

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>