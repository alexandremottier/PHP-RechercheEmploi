<html>
<head>
    <title>Liste des entreprises</title>
</head>
<body>
    <h1>Liste des entreprises</h1>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("class/sqlconnect.php");

// Récupère les données de la table Entreprise
$sql = "SELECT Entreprise.ID, Entreprise.NomSociete, Contact.ID, Contact.Prenom, Contact.Nom, Entreprise.Adresse, StatutEntretien.Statut
FROM Entreprise
LEFT JOIN Contact ON Entreprise.ID = Contact.IDEntreprise
LEFT JOIN StatutEntretien ON Entreprise.StatutEntretien = StatutEntretien.ID";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Impossible de récupérer les données: " . mysqli_error($conn));
}

echo "<table style='border:1px solid #000;'>";
echo "<tr><th style='border:1px solid #000;'>Nom de la société</th><th style='border:1px solid #000;'>Contact</th><th style='border:1px solid #000;'>Adresse</th><th style='border:1px solid #000;'>Statut</th></tr>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='border:1px solid #000;'>" . $row['NomSociete'] . "</td>";
    echo "<td style='border:1px solid #000;'>" . "<a href='infocontact.php?ID=" . $row['ID'] . "'>" . $row['Prenom'] . ' ' . $row['Nom'] . "</a>" . "</td>";
    echo "<td style='border:1px solid #000;'>" . $row['Adresse'] . "</td>";
    echo "<td style='border:1px solid #000;'>" . $row['Statut'] . "</td>";
    echo '</tr>';
}
echo "</table>";
mysqli_close($conn);
?>
<br>
<button onclick="window.location.href='ajoutentreprise.php'" class="button">Créer une entreprise</button>
<button onclick="window.location.href='ajoutcontact.php'" class="button">Créer un contact</button>
<button onclick="window.location.href='modificationstatut.php'" class="button">Modifier le statut pour une entreprise</button>