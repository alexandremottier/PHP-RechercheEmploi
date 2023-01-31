<html>
<head>
    <title>Modifier un entretien présentiel/visio</title>
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
include_once 'class/sqlconnect.php';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT ID FROM users WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $idsession = $result['ID'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
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
    <legend><font size="6">Modifier un entretien présentiel/visio</font></legend>
      <font size="5">Société <?php echo $row['NomSociete'] ?></font><br>
      <font size="5">Votre interlocuteur(trice) : <?php echo $row2['Prenom'] . " " . $row2['Nom'] ?></font>
  </fieldset><br>
<?php
    include('class/sqlconnect.php');
    $id = $_GET['ID'];
    $sql = "SELECT * FROM EntretienPresentiel JOIN Contact ON EntretienPresentiel.IDContact = Contact.ID WHERE Contact.ID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<form action="modifentretienphy.php" method="post">
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
          <textarea id="Suivi" name="Suivi" rows="20" cols="150"><?php echo $row['SuiviEntretien']; ?></textarea>
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
    $poste = str_replace("'", "\'", $poste);
    $suivi = $_POST['Suivi'];
    $suivi = htmlentities($suivi);
    $suivi = str_replace("'", "\'", $suivi);

$sql = "UPDATE EntretienPresentiel SET DateHeurePrevueEntretien='$dateHeurePrevueEntretien', DateHeureEffectiveEntretien='$dateHeureEffectiveEntretien', PonctualiteEntreprise='$ponctualiteEntreprise', Remuneration='$remuneration', PosteAborde='$poste', SuiviEntretien='$suivi' WHERE IDContact='$id'";

if ($conn->query($sql) === TRUE) {
    echo "L'entretien a été modifié avec succès";
    header("Location: infoentretien.php?ID=" . $id);
} else {
    echo "Erreur lors de la modification : " . $conn->error;
}
}
?>
