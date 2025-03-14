<!-- Ici c'est un fichier où faire des testes en cas de besoins -->
<?php
if(isset($_GET['response'])) {
    $resp = $_GET['response'];
    echo $resp;
} else {
    echo "non reçu...";
}