<?php
    include 'class/sqlconnect.php';
    $query = "SELECT ID, NomSociete, Adresse FROM Entreprise";
    $result = mysqli_query($conn, $query);
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value={$row['ID']}>{$row['NomSociete']} - {$row['Adresse']}</option>";
    }

    $query = "SELECT ID, Prenom, Nom, Mobile, IDEntreprise FROM Contact";
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
    <title>Création d'un entretien physique/visio</title>
    <meta name="viewport" content="width=device-width">
</head>
<body>
  <a href="index.php">Revenir à l'accueil</a><br><br>
  <h1>Création d'un entretien physique/visio</h1>
    <form action="creationentretienphy.php" method="post">
      <table style='border:1px solid #000;'>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="idEntreprise">Nom de l'entreprise :</label>
          </td>
          <td style='border:1px solid #000;'>
            <select id="idEntreprise" name="idEntreprise">
            <?php echo $options; ?>
            </select>
          </td>
        </tr>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="idContact">Contact de l'entreprise :</label>
          </td>
          <td style='border:1px solid #000;'>
            <select id="idContact" name="idContact">
            <?php echo $options2; ?>
            </select>
          </td>
        </tr>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="dateHeurePrevueEntretien">Date/heure prévue de l'entretien :</label>
          </td>
          <td style='border:1px solid #000;'>
            <input type="datetime-local" id="dateHeurePrevueEntretien" name="dateHeurePrevueEntretien">
          </td>
        </tr>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="dateHeureEffectiveEntretien">Date/heure effective de l'entretien :</label>
          </td>
          <td style='border:1px solid #000;'>
            <input type="datetime-local" id="dateHeureEffectiveEntretien" name="dateHeureEffectiveEntretien">
          </td>
        </tr>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="ponctualiteEntreprise">Ponctualité de l'entreprise :</label>
          </td>
          <td style='border:1px solid #000;'>
            <input type="checkbox" id="ponctualiteEntreprise" name="ponctualiteEntreprise">
          </td>
        </tr>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="remuneration">Rémunération proposée:</label>
          </td>
          <td style='border:1px solid #000;'>
            <input type="text" id="remuneration" name="remuneration" value="<?php echo $remuneration; ?>" >
          </td>
        </tr>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="poste">Poste proposé:</label>
          </td>
          <td style='border:1px solid #000;'>
            <input type="text" id="poste" name="poste" value="<?php echo $poste; ?>" >
          </td>
        </tr>
        <tr style='border:1px solid #000;'>
          <td style='border:1px solid #000;'>
            <label for="suivi">Déroulement et suivi Entretien:</label>
          </td>
          <td style='border:1px solid #000;'>
            <textarea id="suivi" name="suivi" value="<?php echo $suivi; ?>" rows="4" cols="50"></textarea>
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
      $suivi = $_POST['suivi'];

      $sql = "INSERT INTO EntretienPresentiel (IDEntreprise, IDContact, DateHeurePrevueEntretien, DateHeureEffectiveEntretien, PonctualiteEntreprise, Remuneration, PosteAborde, SuiviEntretien)
      VALUES ('$idEntreprise', '$idContact', '$dateHeurePrevueEntretien', '$dateHeureEffectiveEntretien', '$ponctualiteEntreprise', '$remuneration', '$poste', '$suivi')";
      
      if ($conn->query($sql) === TRUE) {
          echo "L'entretien présentiel a été enregistré avec succès.";
      } else {
          echo "Erreur lors de l'enregistrement de l'entretien présentiel: " . $conn->error;
      }
  }

  $conn->close();
  ?>
</body>
</html>
