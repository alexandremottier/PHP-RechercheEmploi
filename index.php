<html>
<head>
  <title>Gestionnaire de recherche d'emploi - Liste des entreprises</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="manifest" href="manifest.json">
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
include_once 'class/sqlconnect.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT first_name, last_name, profession, ID FROM users WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $prenom = $result['first_name'];
    $nom = $result['last_name'];
    $profession = $result['profession'];
    $idsession = $result['ID'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</head>
<body>
  <?php
  // Récupérer l'heure actuelle
  $time = date("H");
  // Créer un message à afficher en fonction de l'heure
  if ($time < "18") {
      $greet = "Bonjour";
  } else {
      $greet = "Bonsoir";
  }
  ?>
  <fieldset>
    <legend><font size="6"><?php echo $greet . ", " . $result['first_name'] . " !" ?></font></legend>
    <font size="5">Poste recherché : <?php echo $profession ?></font><br>
    <br><font size="2"><a href="logout.php">Se déconnecter</a> - <a href="modifprofil.php">Modifier votre profil</a> - <a href="https://github.com/alexandremottier/PHP-RechercheEmploi" target="_blank">Made with ♥️ by Aiden</a></font>
  </fieldset><br>
    <font size="5">Votre recherche d'emploi - Liste de vos entreprises</font><br>
<br>
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

echo "<table>";
echo "<tr><th>Société</th><th>Contact</th><th>Adresse</th><th>Statut</th><th>Entretiens</th></tr>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if (!empty($row['Mobile'])) {
        $mobile = strval($row["Mobile"]);
        $mobile = substr($mobile, 0, 2) . "." . substr($mobile, 2, 2) . "." . substr($mobile, 4, 2) . "." . substr($mobile, 6, 2) . "." . substr($mobile, 8, 2);
        $mobile = '&nbsp;<br>(' . $mobile . ')';
    } else {
        $mobile = '';
    }
    echo "<tr>";
    echo "<td>" . "<a href='modifentreprise.php?ID=" . $row['EntrepriseID'] . "'>&nbsp;" . $row['NomSociete'] . "&nbsp;</a></td>";
    echo "<td>" . "<a href='infocontact.php?ID=" . $row['ID'] . "'>&nbsp;" . $row['Prenom'] . ' ' . $row['Nom'] . ' ' . $mobile . "</a></td>";
    echo "<td>&nbsp;" . $row['Adresse'] . "&nbsp;</td>";
    echo "<td>&nbsp;" . $row['Statut'] . "&nbsp;</td>";
    echo "<td>" . "<a href='infoentretien.php?ID=" . $row['ID'] . "'>&nbsp;Afficher les entretiens&nbsp;</a></td>";
    echo '</tr>';
}

echo "</table>";
mysqli_close($conn);
?>
<br>
<font size="3">
<a href="ajoutentreprise.php">Créer une entreprise</a>&nbsp;-&nbsp;
<a href="ajoutcontact.php">Créer un contact</a>&nbsp;-&nbsp;
<a href="creationentretientel.php">Créer un entretien téléphonique</a>&nbsp;-&nbsp;
<a href="creationentretienphy.php">Créer un entretien présentiel ou visio</a>
</font>
<br><br>
<p>En cas de problème, vous pouvez contacter l'<a href="mailto:support@am-networks.fr?subject=Problème sur outil RechercheEmploi">équipe support</a>.
<br>En cas de bug applicatif, vous pouvez créer une <a href="https://github.com/alexandremottier/PHP-RechercheEmploi/issues/new" target="_blank">issue sur GitHub</a>.
</p>
</body>
</html>
