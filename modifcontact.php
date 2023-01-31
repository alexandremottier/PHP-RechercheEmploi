<html>
<head>
    <title>Modifier un contact</title>
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
    <h1>Modifier un contact</h1>
<?php
    include('class/sqlconnect.php');
    $id = $_GET['ID'];
    $sql = "SELECT * FROM Contact WHERE ID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<a href="index.php">Revenir à l'accueil</a><br><br>
<form action="modifcontact.php" method="post">
  <table>
    <tr>
      <td>
        <input type="hidden" name="ID" value="<?php echo $id; ?>">
        <label>Prénom :</label>
      </td>
      <td>
        <input type="text" name="Prenom" value="<?php echo $row['Prenom']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Nom :</label>
      </td>
      <td>
        <input type="text" name="Nom" value="<?php echo $row['Nom']; ?>">
      </td>
    <tr>
      <td>
        <label>Poste :</label>
      </td>
      <td>
        <input type="text" name="Poste" value="<?php echo $row['Poste']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Entreprise :</label>
      </td>
      <td>
        <select name="IDEntreprise">
            <?php
                $sql = "SELECT * FROM Entreprise";
                $result = $conn->query($sql);
                while ($entreprise = $result->fetch_assoc()) {
                    if ($entreprise['ID'] == $row['IDEntreprise']) {
                        echo "<option value='" . $entreprise['ID'] . "' selected>" . $entreprise['NomSociete'] . "</option>";
                    } else {
                        echo "<option value='" . $entreprise['ID'] . "'>" . $entreprise['NomSociete'] . "</option>";
                    }
                }
            ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Numéro de mobile :</label>
      </td>
      <td>
        <input type="text" name="Mobile" value="<?php echo $row['Mobile']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Adresse e-mail :</label>
      </td>
      <td>
        <input type="email" name="Mail" value="<?php echo $row['Mail']; ?>">
      </td>
    </tr>
    </table>
    <br>
    <input type="submit" name="submit" value="Enregistrer les modifications">
</form>

<?php
if(isset($_POST['submit'])) {
$id = $_POST['ID'];
$prenom = $_POST['Prenom'];
$nom = $_POST['Nom'];
$poste = $_POST['Poste'];
$poste = htmlentities($poste);
$poste = str_replace("'", "\'", $poste);
$entreprise = $_POST['IDEntreprise'];
$mobile = $_POST['Mobile'];
$mail = $_POST['Mail'];

$sql = "UPDATE Contact SET Prenom='$prenom', Nom='$nom', Poste='$poste', IDEntreprise='$entreprise', Mobile='$mobile', Mail='$mail' WHERE ID='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Le contact a été modifié avec succès";
    header("refresh:1; url=infocontact.php?ID=".$id);
} else {
    echo "Erreur lors de la modification : " . $conn->error;
}
}
?>
