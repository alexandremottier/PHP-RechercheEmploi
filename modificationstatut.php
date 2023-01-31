<!DOCTYPE html>
<html>
<head>
    <title>Modification statut entretien</title>
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
include("class/sqlconnect.php");
?>
<body>
  <a href="index.php">Revenir à l'accueil</a><br><br>
    <form action="modificationstatut.php" method="post">
      <table>
        <tr>
          <td>
            <label for="entreprise">Entreprise</label>
          </td>
          <td>
            <select name="entreprise" id="entreprise">
                <?php
                    $sql = "SELECT ID, NomSociete FROM Entreprise";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='" . $row['ID'] . "'>" . $row['NomSociete'] . "</option>";
                    }
                ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <label for="statut">Statut d'entretien</label>
          </td>
          <td>
            <select name="statut" id="statut">
                <?php
                    $sql = "SELECT ID, Statut FROM StatutEntretien";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='" . $row['ID'] . "'>" . $row['Statut'] . "</option>";
                    }
                ?>
            </select>
          </td>
        </tr>
      </table>
        <br>
        <input type="submit" name="submit" value="Modifier statut">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $entreprise = $_POST['entreprise'];
            $statut = $_POST['statut'];

            $sql = "UPDATE Entreprise SET StatutEntretien = '$statut' WHERE ID = '$entreprise'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "Statut d'entretien mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour du statut d'entretien : " . mysqli_error($conn);
            }
        }
    ?>
</body>
</html>
