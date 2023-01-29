<!DOCTYPE html>
<html>
  <head>
    <title>Inscription</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
    <h1>Inscription</h1>
    <form action="register.php" method="post">
    <table>
      <tr>
        <td>
          <label for="first_name">Prénom :</label>
        </td>
        <td>
          <input type="text" name="first_name" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="last_name">Nom :</label>
        </td>
        <td>
          <input type="text" name="last_name" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="username">Nom d'utilisateur :</label>
        </td>
        <td>
          <input type="text" name="username" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="password">Mot de passe :</label>
        </td>
        <td>
          <input type="password" name="password" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="profession">Profession :</label>
        </td>
        <td>
          <input type="text" name="profession" required>
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
$dbusername = "nom_utilisateur_bdd";
$dbpassword = "mot_de_passe_bdd";
$dbname = "nom_bdd";

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

// Requête d'insertion des informations dans la base de données
$sql = "INSERT INTO users (first_name, last_name, username, password, profession)
VALUES ('$first_name', '$last_name', '$username', '$password', '$profession')";

if (mysqli_query($conn, $sql)) {
  echo "Inscription réussie !";
} else {
  echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>
