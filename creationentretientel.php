<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit;
}
?>
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
    include 'class/sqlconnect.php';
    $query = "SELECT ID, NomSociete FROM Entreprise WHERE UserID =" . $idsession . ";";
    $result = mysqli_query($conn, $query);
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value={$row['ID']}>{$row['NomSociete']}</option>";
    }

    $query = "SELECT ID, Prenom, Nom, Mobile, IDEntreprise FROM Contact WHERE IDUser =" . $idsession . ";";
    $result = mysqli_query($conn, $query);
    $options2 = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $query2 = "SELECT NomSociete FROM Entreprise WHERE ID = {$row['IDEntreprise']}";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $options2 .= "<option value={$row['ID']}>{$row['Prenom']} {$row['Nom']} ({$row['Mobile']}) - {$row2['NomSociete']}</option>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link href="custom.css" rel="stylesheet">
    <title>Création d'un entretien téléphonique</title>
    <meta name="viewport" content="width=device-width">
</head>
<body>
  <a href="index.php">Revenir à l'accueil</a><br><br>
  <h1>Création d'un entretien téléphonique</h1>
    <form action="creationentretientel.php" method="post">
      <table>
        <tr>
          <td>
            <label for="idEntreprise">Nom de l'entreprise :</label>
          </td>
          <td>
            <select id="idEntreprise" name="idEntreprise">
            <?php echo $options; ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <label for="idContact">Contact de l'entreprise :</label>
          </td>
          <td>
            <select id="idContact" name="idContact">
            <?php echo $options2; ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <label for="dateHeurePrevueEntretien">Date/heure prévue de l'entretien :</label>
          </td>
          <td>
            <input type="datetime-local" id="dateHeurePrevueEntretien" name="dateHeurePrevueEntretien">
          </td>
        </tr>
        <tr>
          <td>
            <label for="dateHeureEffectiveEntretien">Date/heure effective de l'entretien :</label>
          </td>
          <td>
            <input type="datetime-local" id="dateHeureEffectiveEntretien" name="dateHeureEffectiveEntretien">
          </td>
        </tr>
        <tr>
          <td>
            <label for="ponctualiteEntreprise">Ponctualité de l'entreprise :</label>
          </td>
          <td>
            <input type="checkbox" value="1" id="ponctualiteEntreprise" name="ponctualiteEntreprise">
          </td>
        </tr>
        <tr>
          <td>
            <label for="remuneration">Rémunération proposée:</label>
          </td>
          <td>
            <input type="text" id="remuneration" name="remuneration" value="<?php echo $remuneration; ?>" >
          </td>
        </tr>
        <tr>
          <td>
            <label for="poste">Poste proposé:</label>
          </td>
          <td>
            <input type="text" id="poste" name="poste" value="<?php echo $poste; ?>" >
          </td>
        </tr>
        <tr>
          <td>
            <label for="suivi">Déroulement et suivi Entretien :</label>
          </td>
          <td>
            <textarea id="suivi" name="suivi" value="<?php echo $suivi; ?>" rows="20" cols="150"></textarea>
          </td>
        </tr>
        </table>
        <br>
        <input type="submit" value="Enregistrer" name="submit">
      </form>
  <?php
  if (isset($_POST['submit'])) {
      $idEntreprise = $_POST['idEntreprise'];
      $idContact = $_POST['idContact'];
      $dateHeurePrevueEntretien = $_POST['dateHeurePrevueEntretien'];
      $dateHeureEffectiveEntretien = $_POST['dateHeureEffectiveEntretien'];
      $ponctualiteEntreprise = $_POST['ponctualiteEntreprise'];
      $remuneration = $_POST['remuneration'];
      $poste = $_POST['poste'];
      $poste = str_replace("'", "\'", $poste);
      $suivi = $_POST['suivi'];
      $suivi = htmlentities($suivi);
      $suivi = str_replace("'", "\'", $suivi);

      $sql = "INSERT INTO EntretienTelephonique (IDEntreprise, IDContact, DateHeurePrevueEntretien, DateHeureEffectiveEntretien, PonctualiteEntreprise, Remuneration, PosteAborde, SuiviEntretien)
      VALUES ('$idEntreprise', '$idContact', '$dateHeurePrevueEntretien', '$dateHeureEffectiveEntretien', '$ponctualiteEntreprise', '$remuneration', '$poste', '$suivi')";

      if ($conn->query($sql) === TRUE) {
          echo "L'entretien téléphonique a été enregistré avec succès.";
          header("refresh:1; url=index.php");
      } else {
          echo "Erreur lors de l'enregistrement de l'entretien téléphonique: " . $conn->error;
      }
  }

  $conn->close();
  ?>
</body>
</html>
