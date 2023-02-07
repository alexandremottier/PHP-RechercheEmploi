<html>
<head>
    <title>Gestionnaire de recherche d'emploi - Afficher un contact</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="manifest" href="manifest.json">
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
    <a href="index.php">Revenir à l'accueil</a><br><br>
    <h1>Afficher un contact</h1>
<?php
include('class/sqlconnect.php');
$id = $_GET['ID'];

$sql = "SELECT Contact.Prenom, Contact.Nom, Contact.Poste, Entreprise.NomSociete, Contact.Mobile, Contact.Mail FROM Contact JOIN Entreprise ON Contact.IDEntreprise = Entreprise.ID WHERE Contact.ID =$id";
$result = mysqli_query($conn, $sql);


echo "<table style='border:1px solid #000;'>";
while($row = $result->fetch_assoc()) {
        $mobile = strval($row["Mobile"]);
        $mobile2 = substr($mobile, 0, 2) . "." . substr($mobile, 2, 2) . "." . substr($mobile, 4, 2) . "." . substr($mobile, 6, 2) . "." . substr($mobile, 8, 2);
        echo "<tr><td style='border:1px solid #000;'>Prénom :</td><td style='border:1px solid #000;'>" . $row["Prenom"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Nom :</td><td style='border:1px solid #000;'>" . $row["Nom"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Poste :</td><td style='border:1px solid #000;'>" . $row["Poste"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Entreprise :</td><td style='border:1px solid #000;'>" . $row["NomSociete"] . "</td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Numéro de mobile :</td><td style='border:1px solid #000;'><a href='tel:" . $row["Mobile"] . "'>" . $mobile2 . "</a></td></tr>";
        echo "<tr><td style='border:1px solid #000;'>Adresse e-mail :</td><td style='border:1px solid #000;'><a href='mailto:" . $row["Mail"] . "'>" . $row["Mail"] . "</a></td></tr>";
    };
$conn->close();
?>
</table>
<br><br>
<button onclick="window.location.href='modifcontact.php?ID=<?php echo $id ?>'" class="button">Modifier le contact</button>
