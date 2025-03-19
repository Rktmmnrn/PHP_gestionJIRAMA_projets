<?php
require_once '../db.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    $stmt = $pdo->prepare("SELECT * FROM CLIENT WHERE nom LIKE :search OR codecli OR mail OR quartier LIKE :search");
    $stmt->execute(['search' => "%$search%"]);
}
// else if ($sortByQuartier) {
//     $stmt = $pdo->query("SELECT * FROM CLIENT ORDER BY quartier");
// }
else {
    $stmt = $pdo->query("SELECT * FROM CLIENT;");
}

// Suppression
if (isset($_GET['codecli'])) {
    $codecli = $_GET['codecli'];

    $stmt = $pdo->prepare("DELETE FROM CLIENT WHERE codecli = ?");
    if ($stmt->execute([$codecli])) {
        echo "Client supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }

    header("Location: listeClient.php");
    exit();
}

$cli = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listes Clients</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            margin: 20px 60px;
        }
        h2 {
            text-transform: capitalize;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        header figure {
            width: 120px;
            height: 120px;
            align-items: center;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        header figure img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        header figure img:hover {
            scale: 1.1;
            transition: ease 200ms;
        }
        header figure span {
            text-transform: uppercase;
            color: #e76610;
            font-weight: bold;
            font-size: 20px;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        main div {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-evenly;
        }
        main div input {
            padding: 5px;
            border: 1px solid;
            border-radius: 10px;
        }
        main div a {
            display: flex;
            align-items: center;
            gap: 5px;
            border: none;
        }
        main div a:hover {
            cursor: pointer;
        }
        main div a span {
            font-weight: bold;
            font-size: 32px;
            padding: 3px;
            border: 1px solid;
            border-radius: 100%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        main div a span:hover {
            background-color: blue;
            color: white;
            transition: ease 200ms;
        }
        a {
            color: black;
            border-radius: 5px;
            padding: 5px;
            border: 1px solid;
        }
        table img {
            width: 20px;
            height: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        table a:first-child {
            color: blue;
        }
        table a:nth-child(2) {
            color: red;
            margin: 0 10px;
        }
        table td {
            padding: 10px;
        }
        table td:last-child {
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        section {
            border: 1px solid;
            position: absolute;
            display: flex;
        }
        section.active {
            display: none;
        }
        @media (min-width: 950px) {
            table td:last-child {
                flex-direction: row;
            }   
        }
    </style>
</head>
<body>
    <header>
        <figure>
            <img src="../img/jirama_logo.webp" alt="logo">
            <span>jirama</span>
        </figure>
        <nav>
            <a href="../index.php">revenir</a>
        </nav>
    </header>
    <main>
        <h2>liste des clients</h2>
        <div>
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Rechercher un CLIENT" value="<?=htmlspecialchars($search) ?>" onchange="this.form.submit()">
            </form>
            <a href="ajoutClient.php" id="addCli"><span>+</span>client</a>
            <!-- <a id="addCli"><span>+</span>client</a> -->
        </div>
        <table>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Sexe</th>
                <th>Quartier</th>
                <th>Niveau</th>
                <th>Email</th>
            </tr>
            <?php foreach ($cli as $cli): ?>
            <tr class="tableTr">
                <td><?= htmlspecialchars($cli['codecli']) ?></td>
                <td><?= htmlspecialchars($cli['nom']) ?></td>
                <td><?= htmlspecialchars($cli['sexe']) ?></td>
                <td><?= htmlspecialchars($cli['quartier']) ?></td>
                <td><?= htmlspecialchars($cli['niveau']) ?></td>
                <td><?= htmlspecialchars($cli['mail']) ?></td>
                <td>
                    <a href="modifClient.php?codecli=<?= $cli['codecli'] ?>"><img src="../img/settings-svgrepo-com (1).svg" alt="modif"></a>
                    <a href="listeClient.php?codecli=<?= $cli['codecli'] ?>" onclick="return confirm('Confirmer la suppression du client : <?= htmlspecialchars($cli['codecli'])?> ?');">🗑</a>
                    <a href="../payement/historiquePayement.php?codecli=<?= $cli['codecli'] ?>" target="_blank">3 derniers Factures</a>
                    <a href="../payement/ajoutFacture.php?codecli=<?= $cli['codecli'] ?>">Facturer !</a>
                    <a href="../compteur/ajoutCompteur.php?codecli=<?= $cli['codecli'] ?>" target="_blank">Ajout Compteur</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <a href="../compteur/afficheCompteur.php" target="_blank">Compteur</a>

        <section id="sectionAdd">
            misy raha
        </section>
    </main>

    <!-- <script src="../js/client.js"></script> -->
     <script>
        document.addEventListener('DOMContentLoaded', ()=> {
        const addCli= document.getElementById('addCli');
        const sectAdd=document.getElementById('sectionAdd');
        addCli.addEventListener('click', ()=>{
            if(sectAdd.classList.contains('active')) {
                sectAdd.classList.remove('active');
            } else {
                sectAdd.classList.add('active');
            }
        });
        })
     </script>
</body>
</html>
