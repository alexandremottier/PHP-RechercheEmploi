<html>
<head>
    <title>Ajouter une entreprise</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
</head>
<?php
include("class/sqlconnect.php");
?>
<body>
    <a href="index.php">Revenir à l'accueil</a><br><br>
    <h1>Ajouter une entreprise</h1>
    <form action="ajoutentreprise.php" method="post">
      <table>
        <tr>
          <td>
            <label for="NomSociete">Nom de la société :</label>
          </td>
          <td>
            <input type="text" id="NomSociete" name="NomSociete" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="Adresse">Adresse postale de la société : (facultatif)</label>
          </td>
          <td>
            <input type="text" id="Adresse" name="Adresse">
          </td>
        </tr>
        <tr>
          <td>
            <label for="NumeroTel">Numéro de téléphone de la société : (facultatif)</label>
          </td>
          <td>
            <input type="text" id="NumeroTel" name="NumeroTel">
          </td>
        </tr>
      </table>
      <br>
        <input type="submit" name="submit" value="Ajouter">
    </form>
    <?php
      if(isset($_POST["submit"])) {
          $NomSociete = $_POST["NomSociete"];
          $Adresse = $_POST["Adresse"];
          $NumeroTel = $_POST["NumeroTel"];
          $StatutEntretien = "2";

          $sql = "INSERT INTO Entreprise (NomSociete, Adresse, NumeroTel, StatutEntretien)
          VALUES ('$NomSociete', '$Adresse', '$NumeroTel', '$StatutEntretien')";
          $result = mysqli_query($conn, $sql);

          if($result) {
              echo "La nouvelle entreprise a été ajoutée avec succès.";
          } else {
              echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
          }
        }
    ?>
