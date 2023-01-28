<html>
<head>
    <title>Afficher les entretiens</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
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
?>
<body>
    <a href="index.php">Revenir à l'accueil</a><br><br>
    <h1>Afficher les entretiens<br>Société <?php echo $row['NomSociete'] ?></h1>
<?php
include('class/sqlconnect.php');
$id = $_GET['ID'];
?>
<h2>Entretien téléphonique</h2>
<?php

$sql = "SELECT EntretienTelephonique.DateHeurePrevueEntretien, EntretienTelephonique.DateHeureEffectiveEntretien, EntretienTelephonique.PonctualiteEntreprise, EntretienTelephonique.Remuneration, EntretienTelephonique.PosteAborde, EntretienTelephonique.SuiviEntretien FROM EntretienTelephonique JOIN Contact ON EntretienTelephonique.IDContact = Contact.ID WHERE Contact.ID =$id";
$result = mysqli_query($conn, $sql);
echo "<table style='border:1px solid #000;'>";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
        $newdatepre = date("d/m/Y H:i", strtotime($row["DateHeurePrevueEntretien"]));
        $newdateeff = date("d/m/Y H:i", strtotime($row["DateHeureEffectiveEntretien"]));
        echo "<tr><td style='border:1px solid #000;'>Date/heure prévue entretien :</td><td style='border:1px solid #000;'>" . $newdatepre . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Date/heure effective entretien :</td><td style='border:1px solid #000;'>" . $newdateeff . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Entreprise ponctuelle :</td><td style='border:1px solid #000;'>" . $row["PonctualiteEntreprise"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Rémunération abordée :</td><td style='border:1px solid #000;'>" . $row["Remuneration"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Poste abordé :</td><td style='border:1px solid #000;'>" . $row["PosteAborde"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Suivi entretien :</td><td style='border:1px solid #000;'>" . $row["SuiviEntretien"] . "</td></tr>";
        echo "<br><button onclick='window.location.href=`modifentretientel.php?ID=" . $id . "`' class='button'>Modifier l'entretien</button>";
    };
  } else {
    echo "<tr colspan='4'><td>Pas de résultat</td></tr>";
  }
$conn->close();
?>
</table>
<br>
<h2>Entretien physique/visio</h2>
<?php
include('class/sqlconnect.php');
$id = $_GET['ID'];
$sql = "SELECT EntretienPresentiel.DateHeurePrevueEntretien, EntretienPresentiel.DateHeureEffectiveEntretien, EntretienPresentiel.PonctualiteEntreprise, EntretienPresentiel.Remuneration, EntretienPresentiel.PosteAborde, EntretienPresentiel.SuiviEntretien FROM EntretienPresentiel JOIN Contact ON EntretienPresentiel.IDContact = Contact.ID WHERE Contact.ID =$id";
$result = mysqli_query($conn, $sql);
echo "<table style='border:1px solid #000;'>";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
        $newdatepre = date("d/m/Y H:i", strtotime($row["DateHeurePrevueEntretien"]));
        $newdateeff = date("d/m/Y H:i", strtotime($row["DateHeureEffectiveEntretien"]));
        echo "<tr><td style='border:1px solid #000;'>Date/heure prévue entretien :</td><td style='border:1px solid #000;'>" . $newdatepre . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Date/heure effective entretien :</td><td style='border:1px solid #000;'>" . $newdateeff . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Entreprise ponctuelle :</td><td style='border:1px solid #000;'>" . $row["PonctualiteEntreprise"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Rémunération abordée :</td><td style='border:1px solid #000;'>" . $row["Remuneration"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Poste abordé :</td><td style='border:1px solid #000;'>" . $row["PosteAborde"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Suivi entretien :</td><td style='border:1px solid #000;'>" . $row["SuiviEntretien"] . "</td></tr>";
        echo "<br><button onclick='window.location.href=`modifentretienphy.php?ID=" . $id . "`' class='button'>Modifier l'entretien</button>";
    };
  } else {
    echo "<tr colspan='4'><td>Pas de résultat</td></tr>";
  }
$conn->close();
?>
</table>
