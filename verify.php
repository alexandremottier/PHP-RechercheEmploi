<title>Inscription</title>
<link href="custom.css" rel="stylesheet">
<meta name="viewport" content="width=device-width">
<?php
session_start();

// Connexion à la base de données
include_once 'class/sqlconnect.php';
// Récupération des identifiants soumis par l'utilisateur
$username = $_POST['username'];
$password = $_POST['password'];

// Requête pour vérifier si les identifiants existent dans la base de données
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

// Si les identifiants sont valides, création d'une session utilisateur
if (mysqli_num_rows($result) == 1) {
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $username;
  header("Location: index.php");
} else {
  echo "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.";
}

mysqli_close($conn);
?>
