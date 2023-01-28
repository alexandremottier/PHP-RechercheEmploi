<html>
<head>
    <title>Modifier un contact</title>
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

<form action="modifcontact.php" method="post">
    <input type="hidden" name="ID" value="<?php echo $id; ?>">
    <label>Prénom :</label>
    <input type="text" name="Prenom" value="<?php echo $row['Prenom']; ?>">
    <br>
    <label>Nom :</label>
    <input type="text" name="Nom" value="<?php echo $row['Nom']; ?>">
    <br>
    <label>Poste :</label>
    <input type="text" name="Poste" value="<?php echo $row['Poste']; ?>">
    <br>
    <label>Entreprise :</label>
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
    <br>
    <label>Numéro de mobile :</label>
    <input type="text" name="Mobile" value="<?php echo $row['Mobile']; ?>">
    <br>
    <input type="submit" name="submit" value="Enregistrer les modifications">
</form>

<?php
if(isset($_POST['submit'])) {
$id = $_POST['ID'];
$prenom = $_POST['Prenom'];
$nom = $_POST['Nom'];
$poste = $_POST['Poste'];
$entreprise = $_POST['IDEntreprise'];
$mobile = $_POST['Mobile'];

$sql = "UPDATE Contact SET Prenom='$prenom', Nom='$nom', Poste='$poste', IDEntreprise='$entreprise', Mobile='$mobile' WHERE ID='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Le contact a été modifié avec succès";
    header("refresh:1; url=infocontact.php?ID=".$id);
} else {
    echo "Erreur lors de la modification : " . $conn->error;
}
}
?>
