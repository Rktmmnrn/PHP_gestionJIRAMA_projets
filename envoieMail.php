<?php
// Déstinataire et envoyeur
$adresse="rfanomezaniavo@gmail.com,martela7@gmail.com";

// Sujet du message
$sujet="Test d'envoie d'une mail avec la fonction mail()";

// Contenu du message
$corps="<html><body>Si je reçois ce <strong> mail</strong>, c'es que c'est Oke!!</body></html>";

// Entête du message
$entete="content-type:text/html\nFrom:rfanomezaniavo@gmail.com\r\nReply-To:martela7@gmail.com";

// Envoie du mail
mail($adresse,$sujet,$corps,$entete);