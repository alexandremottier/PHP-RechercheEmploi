<html>
<head>
  <title>Utilitaire de recherche d'emploi - Liste des entreprises</title>
  <link href="custom.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width">
  <?php
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit;  
} else {
$prenom = $_SESSION['first_name'];
$nom = $_SESSION['last_name'];
$profession = $_SESSION['profession'];
$idsession = $_SESSION['ID'];
}
?>

</head>
<body>
<?php include("config.php") ?>
  <fieldset>
    <legend><font size="5"><?php echo $prenom . " " . $nom ?></font></legend>
    <font size="4"><?php echo $profession ?></font><br>
  </fieldset><br><br>
    <font size="5">Votre recherche d'emploi - Liste des entreprises</font>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("class/sqlconnect.php");

// Récupère les données de la table Entreprise
$sql = "SELECT Entreprise.ID AS EntrepriseID, Entreprise.NomSociete, Contact.ID, Contact.Prenom, Contact.Nom, Contact.Mobile, Entreprise.Adresse, StatutEntretien.Statut
FROM Entreprise
LEFT JOIN Contact ON Entreprise.ID = Contact.IDEntreprise
LEFT JOIN StatutEntretien ON Entreprise.StatutEntretien = StatutEntretien.ID
WHERE Entreprise.UserID = '" . $idsession . "'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Impossible de récupérer les données: " . mysqli_error($conn));
}

echo "<table style='border:1px solid #000;'>";
echo "<tr><th style='border:1px solid #000;'>Nom de la société</th><th style='border:1px solid #000;'>Contact</th><th style='border:1px solid #000;'>Adresse</th><th style='border:1px solid #000;'>Statut</th><th style='border:1px solid #000;'>Entretiens</th></tr>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='border:1px solid #000;'>" . "<a href='modifentreprise.php?ID=" . $row['EntrepriseID'] . "'>" . $row['NomSociete'] . "</td>";
    echo "<td style='border:1px solid #000;'>" . "<a href='infocontact.php?ID=" . $row['ID'] . "'>" . $row['Prenom'] . ' ' . $row['Nom'] . ' (' . $row['Mobile'] . ")</a>" . "</td>";
    echo "<td style='border:1px solid #000;'>" . $row['Adresse'] . "</td>";
    echo "<td style='border:1px solid #000;'>" . $row['Statut'] . "</td>";
    echo "<td style='border:1px solid #000;'>" . "<a href='infoentretien.php?ID=" . $row['ID'] . "'>Afficher les entretiens</a>" . "</td>";
    echo '</tr>';
}
echo "</table>";
mysqli_close($conn);
?>
<br>
<button onclick="window.location.href='ajoutentreprise.php'" class="button">Créer une entreprise</button>
<button onclick="window.location.href='ajoutcontact.php'" class="button">Créer un contact</button>
<button onclick="window.location.href='modificationstatut.php'" class="button">Modifier le statut pour une entreprise</button>
<button onclick="window.location.href='creationentretientel.php'" class="button">Saisir un entretien téléphonique</button>
<button onclick="window.location.href='creationentretienphy.php'" class="button">Saisir un entretien présentiel ou visio</button>
<br><br>
<footer>
<a href="https://github.com/alexandremottier/PHP-RechercheEmploi" target="_blank">Made with love by Aiden ♥️</a>
</footer>
</body>
</html>
