<html>
<head>
    <title>Modifier votre profil</title>
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
    <h1>Modifier votre profil</h1>
<?php
include_once 'class/sqlconnect.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT first_name, last_name, profession, ID, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $prenom = $result['first_name'];
    $nom = $result['last_name'];
    $profession = $result['profession'];
    $idsession = $result['ID'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<a href="index.php">Revenir à l'accueil</a><br><br>
<form action="modifprofil.php" method="post">
  <table>
    <tr>
      <td>
        <input type="hidden" name="ID" size="50" value="<?php echo $result['ID']; ?>">
        <label>Prénom :</label>
      </td>
      <td>
        <input type="text" name="first_name" size="50" value="<?php echo $result['first_name']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label>Nom :</label>
      </td>
      <td>
        <input type="text" name="last_name" size="50" value="<?php echo $result['last_name']; ?>">
      </td>
    <tr>
      <td>
        <label>Profession (renseigner un seul poste) :</label>
      </td>
      <td>
        <input type="text" name="profession" size="50" value="<?php echo $result['profession']; ?>">
      </td>
    </tr>
    <tr>
      <td>
        <label for="password">Mot de passe<br>(seulement si vous souhaitez le modifier) :</label>
      </td>
      <td>
        <input type="password" name="password" size="50" value="<?php echo $result['password']; ?>">
      </td>
    </tr>
    </table>
    <br>
    <input type="submit" name="submit" value="Enregistrer les modifications">
</form>

<?php
include_once 'class/sqlconnect.php';

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
  $id = $_POST['ID'];
  $prenom = $_POST['first_name'];
  $nom = $_POST['last_name'];
  $profession = $_POST['profession'];
  $password = $_POST['password'];

  $sql = "UPDATE users SET first_name='$prenom', last_name='$nom', profession='$profession', password='$password' WHERE ID='$id'";

  if ($conn->query($sql) === TRUE) {
      echo "Votre profil a été modifié avec succès";
      header("refresh:1; url=index.php");
  } else {
      echo "Votre profil a été modifié avec succès";
      header("refresh:1; url=index.php");
  }
}
?>
