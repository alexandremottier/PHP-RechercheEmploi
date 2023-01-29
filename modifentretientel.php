<html>
<head>
    <title>Modifier un entretien téléphonique</title>
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
    <h1>Modifier un entretien téléphonique<br>Société <?php echo $row['NomSociete'] ?></h1>
<?php
    include('class/sqlconnect.php');
    $id = $_GET['ID'];
    $sql = "SELECT * FROM EntretienTelephonique JOIN Contact ON EntretienTelephonique.IDContact = Contact.ID WHERE Contact.ID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<a href="index.php">Revenir à l'accueil</a><br><br>
<form action="modifentretientel.php" method="post">
  <table style='border:1px solid #000;'>
      <tr style='border:1px solid #000;'>
        <td style='border:1px solid #000;'>
          <input type="hidden" name="ID" value="<?php echo $id; ?>">
          <label for="DateHeurePrevueEntretien">Date/heure prévue de l'entretien :</label>
        </td>
        <td style='border:1px solid #000;'>
          <input type="datetime-local" id="DateHeurePrevueEntretien" name="DateHeurePrevueEntretien" value="<?php echo $row['DateHeurePrevueEntretien']; ?>">
        </td>
      </tr>
      <tr style='border:1px solid #000;'>
        <td style='border:1px solid #000;'>
          <label for="DateHeureEffectiveEntretien">Date/heure effective de l'entretien :</label>
        </td>
        <td style='border:1px solid #000;'>
          <input type="datetime-local" id="DateHeureEffectiveEntretien" name="DateHeureEffectiveEntretien" value="<?php echo $row['DateHeureEffectiveEntretien']; ?>">
        </td>
      </tr>
      <tr style='border:1px solid #000;'>
        <td style='border:1px solid #000;'>
          <label for="PonctualiteEntreprise">Ponctualité de l'entreprise :</label>
        </td>
        <td style='border:1px solid #000;'>
          <input type="checkbox" id="PonctualiteEntreprise" name="PonctualiteEntreprise" value="1" <?php if ($row['PonctualiteEntreprise'] == 1) echo "checked"; ?>>
        </td>
      </tr>
      <tr style='border:1px solid #000;'>
        <td style='border:1px solid #000;'>
          <label for="Remuneration">Rémunération proposée:</label>
        </td>
        <td style='border:1px solid #000;'>
          <input type="text" id="Remuneration" name="Remuneration" value="<?php echo $row['Remuneration']; ?>">
        </td>
      </tr>
      <tr style='border:1px solid #000;'>
        <td style='border:1px solid #000;'>
          <label for="Poste">Poste proposé:</label>
        </td>
        <td style='border:1px solid #000;'>
          <input type="text" id="Poste" name="Poste" value="<?php echo $row['PosteAborde']; ?>">
        </td>
      </tr>
      <tr style='border:1px solid #000;'>
        <td style='border:1px solid #000;'>
          <label for="Suivi">Déroulement et suivi Entretien :</label>
        </td>
        <td style='border:1px solid #000;'>
          <?php $row['SuiviEntretien'] = str_replace("\'", "'", $row['SuiviEntretien']); ?>
          <textarea id="Suivi" name="Suivi"><?php echo $row['SuiviEntretien']; ?></textarea>
        </td>
      </tr>
    </table>
    <br>
    <input type="submit" name="submit" value="Enregistrer les modifications">
</form>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['ID'];
    $dateHeurePrevueEntretien = $_POST['DateHeurePrevueEntretien'];
    $dateHeureEffectiveEntretien = $_POST['DateHeureEffectiveEntretien'];
    $ponctualiteEntreprise = $_POST['PonctualiteEntreprise'];
    $remuneration = $_POST['Remuneration'];
    $poste = $_POST['Poste'];
    $suivi = $_POST['Suivi'];
    $suivi = htmlentities($suivi);
    $suivi = str_replace("'", "\'", $suivi);

$sql = "UPDATE EntretienTelephonique SET DateHeurePrevueEntretien='$dateHeurePrevueEntretien', DateHeureEffectiveEntretien='$dateHeureEffectiveEntretien', PonctualiteEntreprise='$ponctualiteEntreprise', Remuneration='$remuneration', PosteAborde='$poste', SuiviEntretien='$suivi' WHERE IDContact='$id'";

if ($conn->query($sql) === TRUE) {
    echo "L'entretien a été modifié avec succès";
    header("refresh:1; url=index.php");
} else {
    echo "Erreur lors de la modification : " . $conn->error;
}
}
?>
