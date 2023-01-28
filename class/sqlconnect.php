<?php
$serveur = "localhost";
$login = "rechercheemploi";
$motDePasse = "rechercheemploi";
$base = "rechercheemploi";

$conn = new mysqli($serveur, $login, $motDePasse, $base);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

?>
