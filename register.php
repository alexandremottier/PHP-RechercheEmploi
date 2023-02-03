<!DOCTYPE html>
<html>
  <head>
    <title>Gestionnaire de recherche d'emploi - Inscription</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
    <h1>Gestionnaire de recherche d'emploi - Inscription</h1>
    <h2>C'est le moment où vous parlez de vous ! 🙂</h2>
    <form action="register.php" method="post">
    <table>
      <tr style='border:0px;'>
        <td style='border:0px;'>
          <label for="first_name">&nbsp;Prénom :</label>
        </td>
        <td style='border:0px;'>
          <input type="text" name="first_name" size="50" required>
        </td>
      </tr>
      <tr style='border:0px;'>
        <td style='border:0px;'>
          <label for="last_name">&nbsp;Nom :</label>
        </td>
        <td style='border:0px;'>
          <input type="text" name="last_name" size="50" required>
        </td>
      </tr>
      <tr style='border:0px;'>
        <td style='border:0px;'>
          <label for="username">&nbsp;Nom d'utilisateur :</label>
        </td>
        <td style='border:0px;'>
          <input type="text" name="username" size="50" required>
        </td>
      </tr>
      <tr style='border:0px;'>
        <td style='border:0px;'>
          <label for="password">&nbsp;Mot de passe :</label>
        </td>
        <td style='border:0px;'>
          <input type="password" name="password" size="50" required>
        </td>
      </tr>
      <tr style='border:0px;'>
        <td style='border:0px;'>
          <label for="profession">&nbsp;Profession (un seul poste) :</label>
        </td>
        <td style='border:0px;'>
          <input type="text" name="profession" size="50" required>
        </td>
      </tr>
    </table><br>
      <input type="submit" name="submit" value="S'inscrire">
    </form>
  </body>
</html>
<?php
// Connexion à la base de données
$host = "localhost";
$dbusername = "prod_rechercheemploi";
$dbpassword = "admin";
$dbname = "admin";

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
  die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Récupération des informations soumises par l'utilisateur
if(isset($_POST['submit'])) {
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$profession = $_POST['profession'];
$profession = htmlentities($profession);
$profession = str_replace("/", "\/", $profession);

// Requête d'insertion des informations dans la base de données
$sql = "INSERT INTO users (first_name, last_name, username, password, profession)
VALUES ('$first_name', '$last_name', '$username', '$password', '$profession')";

if (mysqli_query($conn, $sql)) {
  echo "Inscription réussie !";
  header("refresh:1; url=index.php");
} else {
  echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>
