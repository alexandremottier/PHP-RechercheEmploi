<!DOCTYPE html>
<html>
  <head>
    <title>Connexion</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
    <h1>Connexion</h1>
    <form action="verify.php" method="post">
      <table>
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
      </table>
          <br>
          <input type="submit" value="Se connecter">
    </form><br><br>
    Vous pouvez aussi <a href="register.php">Créer un compte</a>
  </body>
</html>
