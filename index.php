<?php
echo "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            list-style-type: none;
            text-decoration: none;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            margin: 20px 60px;
        }
        a {
            color: black;
            text-transform: uppercase;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        header figure {
            width: 120px;
            height: 120px;
            align-items: center;
            display: flex;
            flex-direction: column;
            gap: 5px;
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
        img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        main {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin: 100px 0;
        }
        main a p {
            font-size: 28px;
        }
        main a {
            border-radius: 20px;
            cursor: pointer;
            width: 200px;
            height: 230px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        main a:hover {
            box-shadow: 0px 1px 5px 0px gray;
        }
        main a figure {
            width: 50%;
            height: 100%;
            position: relative;
        }
        main a figure img {
            position: absolute;
            width: 100%;
        }
        footer {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <header>
        <figure>
            <img src="img/jirama_logo.webp" alt="logo">
            <span>jirama</span>
        </figure>
        <nav>
            <a href="">menu</a>
        </nav>
    </header>
    <main>
        <a href="client/listeClient.php">
            <figure><img src="img/client-svgrepo-com.svg" alt="client"></figure>
            <p>client</p>
        </a>
        <a href="compteur/afficheCompteur.php">
            <figure><img src="img/counter-svgrepo-com.svg" alt="compteur"></figure>
            <p>compteur</p>
        </a>
        <a href="payement/listePaiement.php">
            <figure><img src="img/payment-bitcoin-svgrepo-com.svg" alt="paiement"></figure>
            <p>payement</p>
        </a>
        <a href="relever/eau/listeEau.php">
            <figure><img src="img/water-drop-svgrepo-com.svg" alt="eau"></figure>
            <p>eau</p>
        </a>
        <a href="relever/elec/listeElec.php">
            <figure><img src="img/electricity-svgrepo-com.svg" alt="elec"></figure>
            <p>électricité</p>
        </a>
    </main>
    <footer>
        <p>tout doit reserver</p>
    </footer>
</body>
</html>