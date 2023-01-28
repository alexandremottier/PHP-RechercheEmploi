<?php
if(isset($_POST['submit'])) {
$id = $_GET['ID'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$poste = $_POST['poste'];
$entreprise = $_POST['entreprise'];
$mobile = $_POST['mobile'];

$sql = "UPDATE Contact SET Prenom='$prenom', Nom='$nom', Poste='$poste', IDEntreprise='$entreprise', Mobile='$mobile' WHERE ID='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Le contact a été modifié avec succès";
    echo $sql;
    // header("refresh:1; url=infocontact.php?ID=".$id);
} else {
    echo "Erreur lors de la modification : " . $conn->error;
}
}
?>
