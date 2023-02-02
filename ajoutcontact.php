<html>
<head>
    <title>Ajouter un contact</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <h1>Ajouter un contact</h1>
<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: login.php");
  exit;
} else {
$prenom = $_SESSION['first_name'];
$nom = $_SESSION['last_name'];
$profession = $_SESSION['profession'];
$idsession = $_SESSION['ID'];
}
include_once 'class/sqlconnect.php';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT ID FROM users WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $idsession = $result['ID'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
    include 'class/sqlconnect.php';

    if(isset($_POST['submit'])){
        $prenom = $_POST['Prenom'];
        $nom = $_POST['Nom'];
        $poste = $_POST['Poste'];
        $poste = htmlentities($poste);
        $poste = str_replace("'", "\'", $poste);
        $mobile = $_POST['Mobile'];
        $entreprise = $_POST['IDEntreprise'];
        $mail = $_POST['Mail'];

        $sql = "INSERT INTO Contact (Prenom, Nom, Poste, Mobile, IDEntreprise, IDUser, Mail) VALUES ('$prenom', '$nom', '$poste', '$mobile', '$entreprise', '$idsession', '$mail')";
        mysqli_query($conn, $sql);
    }
?>
<a href="index.php">Revenir à l'accueil</a><br><br>
<form method="post" action="">
  <table>
    <tr>
      <td>
        <label for="Prenom">Prénom :</label>
      </td>
      <td>
        <input type="text" name="Prenom" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="Nom">Nom :</label>
      </td>
      <td>
        <input type="text" name="Nom" required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="Poste">Poste occupé :</label>
      </td>
      <td>
        <input type="text" name="Poste" >
      </td>
    </tr>
    <tr>
      <td>
        <label for="Mobile">Numéro de mobile (format 0102030405) :</label>
      </td>
      <td>
        <input type="text" name="Mobile" pattern="0[0-9]{9}" >
      </td>
    </tr>
    <tr>
      <td>
        <label for="Mail">Adresse e-mail :</label>
      </td>
      <td>
        <input type="email" name="Mail" >
      </td>
    </tr>
    <tr>
      <td>
        <label for="Entreprise">Entreprise :</label>
      </td>
      <td>
        <select name="IDEntreprise">
            <?php
                $sql = "SELECT ID, NomSociete FROM Entreprise WHERE UserID =" . $idsession . ";";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<option value='" . $row['ID'] . "'>" . $row['NomSociete'] . "</option>";
                }
            ?>
        </select>
      </td>
    </tr>
  </table>
  <br>
  <input type="submit" name="submit" value="Ajouter">
</form>
</body>
</html>
