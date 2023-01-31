<html>
<head>
    <title>Modifier une entreprise</title>
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
<body>
  <fieldset>
    <legend><font size="6">Modifier une entreprise</font></legend>
    <?php
        include('class/sqlconnect.php');
        $id = $_GET['ID'];
        $sql = "SELECT * FROM Entreprise WHERE ID = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $entreprise_id = $row['StatutEntretien'];
    ?>
    <font size="5">Société <?php echo $row['NomSociete'] ?></font>
  </fieldset><br>
<a href="index.php">Revenir à l'accueil</a><br><br>
<form action="modifentreprise.php" method="post">
  <table>
    <tr>
      <td>
        <input type="hidden" name="ID" value="<?php echo $id; ?>">
        <label>Nom de la société :</label>
      </td>
      <td>
        <input type="text" name="NomSociete" value="<?php echo $row['NomSociete']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Adresse :</label>
      </td>
      <td>
        <input type="text" name="Adresse" value="<?php echo $row['Adresse']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Numéro de téléphone :</label>
      </td>
      <td>
        <input type="text" name="NumeroTel" value="<?php echo $row['NumeroTel']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Statut :</label>
      </td>
      <td>
        <select name="statut" id="statut">
            <?php
                include('class/sqlconnect.php');
                $sql = "SELECT StatutEntretien.ID, StatutEntretien.Statut FROM StatutEntretien";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                  if ($row['ID'] == $entreprise_id) {
                     echo "<option value='" . $row['ID'] . "' selected>" . $row['Statut'] . "</option>";
                    } else {
                     echo "<option value='" . $row['ID'] . "'>" . $row['Statut'] . "</option>";
                    }
                }
            ?>
        </select>
    </table>
    <br>
    <input type="submit" name="submit" value="Enregistrer les modifications">
</form>

<?php
if(isset($_POST['submit'])) {
$id = $_POST['ID'];
$nomsociete = $_POST['NomSociete'];
$adresse = $_POST['Adresse'];
$adresse = htmlentities($adresse);
$adresse = str_replace("'", "\'", $adresse);
$numerotel = $_POST['NumeroTel'];
$statut = $_POST['statut'];

$sql = "UPDATE Entreprise SET NomSociete='$nomsociete', Adresse='$adresse', NumeroTel='$numerotel', StatutEntretien='$statut' WHERE ID='$id'";

if ($conn->query($sql) === TRUE) {
    echo "La société a été modifiée avec succès";
    header("Location: index.php");
} else {
    echo "Erreur lors de la modification : " . $conn->error;
}
}
?>
