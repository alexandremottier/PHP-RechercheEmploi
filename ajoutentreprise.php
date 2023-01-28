<html>
<head>
    <title>Ajouter une entreprise</title>
</head>
<?php
include("class/sqlconnect.php");
?>
<body>
    <h1>Ajouter une entreprise</h1>
    <form action="ajoutentreprise.php" method="post">
        <label for="NomSociete">Nom de la société:</label>
        <input type="text" id="NomSociete" name="NomSociete" required>
        <br>
        <label for="Adresse">Adresse postale de la société:</label>
        <input type="text" id="Adresse" name="Adresse">
        <br>
        <label for="NumeroTel">Numéro de téléphone de la société:</label>
        <input type="text" id="NumeroTel" name="NumeroTel">
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
