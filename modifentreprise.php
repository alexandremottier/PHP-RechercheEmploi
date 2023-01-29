<html>
<head>
    <title>Modifier une entreprise</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <h1>Modifier une entreprise</h1>
<?php
    include('class/sqlconnect.php');
    $id = $_GET['ID'];
    $sql = "SELECT * FROM Entreprise WHERE ID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
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
    </table>
    <br>
    <input type="submit" name="submit" value="Enregistrer les modifications">
</form>

<?php
if(isset($_POST['submit'])) {
$id = $_POST['ID'];
$nomsociete = $_POST['NomSociete'];
$adresse = $_POST['Adresse'];
$numerotel = $_POST['NumeroTel'];

$sql = "UPDATE Entreprise SET NomSociete='$nomsociete', Adresse='$adresse', NumeroTel='$numerotel' WHERE ID='$id'";

if ($conn->query($sql) === TRUE) {
    echo "La société a été modifiée avec succès";
    header("refresh:1; url=index.php");
} else {
    echo "Erreur lors de la modification : " . $conn->error;
}
}
?>
