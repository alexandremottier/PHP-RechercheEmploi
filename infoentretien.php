<html>
<head>
    <title>Gestionnaire de recherche d'emploi - Afficher les entretiens</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="manifest" href="manifest.json">
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
    <?php
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit;
}
?>

</head>
<?php
include('class/sqlconnect.php');
$id = $_GET['ID'];
$sql = "SELECT NomSociete FROM Entreprise JOIN Contact ON Entreprise.ID = Contact.IDEntreprise WHERE Contact.ID =$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
}
$conn->close();
include('class/sqlconnect.php');
$sql2 = "SELECT Prenom, Nom FROM Contact WHERE Contact.ID =$id";
$result2 = mysqli_query($conn, $sql2);
if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
$conn->close();
}
?>
<body>
    <a href="index.php">Revenir à l'accueil</a><br><br>
    <fieldset>
      <legend><font size="6">Afficher les entretiens</font></legend>
        <font size="5">Société <?php echo $row['NomSociete'] ?></font><br>
        <font size="5">Votre interlocuteur(trice) : <?php echo $row2['Prenom'] . " " . $row2['Nom'] ?></font>
    </fieldset>
<?php
include('class/sqlconnect.php');
$id = $_GET['ID'];
?>
<h2>Entretien téléphonique</h2>
<?php

$sql = "SELECT EntretienTelephonique.DateHeurePrevueEntretien, EntretienTelephonique.DateHeureEffectiveEntretien, EntretienTelephonique.PonctualiteEntreprise, EntretienTelephonique.Remuneration, EntretienTelephonique.PosteAborde, EntretienTelephonique.SuiviEntretien FROM EntretienTelephonique JOIN Contact ON EntretienTelephonique.IDContact = Contact.ID WHERE Contact.ID =$id";
$result = mysqli_query($conn, $sql);
echo "<table>";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
        $suivi = $row['SuiviEntretien'];
        $suivi = html_entity_decode($suivi);
        $suivi = nl2br($suivi);
        $newdatepre = date("d/m/Y H:i", strtotime($row["DateHeurePrevueEntretien"]));
        $newdateeff = date("d/m/Y H:i", strtotime($row["DateHeureEffectiveEntretien"]));
        if ($row["PonctualiteEntreprise"] == 1) {
          $ponctualite = "OUI";
        } else {
          $ponctualite = "NON";
        };
        echo "<tr><td>&nbsp; Date/heure prévue entretien &nbsp;</td><td>&nbsp; " . $newdatepre . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Date/heure effective entretien &nbsp;</td><td> &nbsp;" . $newdateeff . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Entreprise ponctuelle &nbsp;</td><td>&nbsp; " . $ponctualite . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Rémunération abordée &nbsp;</td><td>&nbsp; " . $row["Remuneration"] . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Poste abordé &nbsp;</td><td>&nbsp; " . $row["PosteAborde"] . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Déroulement et suivi entretien &nbsp;</td><td>" . $suivi . "</td></tr>";
        echo "<br><a href='modifentretientel.php?ID=" . $id . "'>Modifier l'entretien</a>";
    };
  } else {
    echo "<tr colspan='4'><td>&nbsp; Pas de résultat &nbsp;</td></tr>";
  }
$conn->close();
?>
</table>
<br>
<h2>Entretien présentiel/visio</h2>
<?php
include('class/sqlconnect.php');
$id = $_GET['ID'];
$sql = "SELECT EntretienPresentiel.DateHeurePrevueEntretien, EntretienPresentiel.DateHeureEffectiveEntretien, EntretienPresentiel.PonctualiteEntreprise, EntretienPresentiel.Remuneration, EntretienPresentiel.PosteAborde, EntretienPresentiel.SuiviEntretien FROM EntretienPresentiel JOIN Contact ON EntretienPresentiel.IDContact = Contact.ID WHERE Contact.ID =$id";
$result = mysqli_query($conn, $sql);
echo "<table>";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
        $suivi = $row['SuiviEntretien'];
        $suivi = html_entity_decode($suivi);
        $suivi = nl2br($suivi);
        $newdatepre = date("d/m/Y H:i", strtotime($row["DateHeurePrevueEntretien"]));
        $newdateeff = date("d/m/Y H:i", strtotime($row["DateHeureEffectiveEntretien"]));
        if ($row["PonctualiteEntreprise"] == 1) {
          $ponctualite = "OUI";
        } else {
          $ponctualite = "NON";
        };
        echo "<tr><td>&nbsp; Date/heure prévue entretien &nbsp;</td><td>&nbsp; " . $newdatepre . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Date/heure effective entretien &nbsp;</td><td>&nbsp; " . $newdateeff . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Entreprise ponctuelle &nbsp;</td><td>&nbsp; " . $ponctualite . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Rémunération abordée &nbsp;</td><td>&nbsp; " . $row["Remuneration"] . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Poste abordé &nbsp;</td><td>&nbsp; " . $row["PosteAborde"] . " &nbsp;</td></tr>";
        echo "<tr><td>&nbsp; Déroulement et suivi entretien &nbsp;</td><td>" . $suivi . "</td></tr>";
        echo "<br><a href='modifentretienphy.php?ID=" . $id . "'>Modifier l'entretien</a>";
    };
  } else {
    echo "<tr colspan='4'><td>&nbsp; Pas de résultat &nbsp;</td></tr>";
  }
$conn->close();
?>
</table>
</body>
</html>
