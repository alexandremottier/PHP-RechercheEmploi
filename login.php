<!DOCTYPE html>
<html>
  <head>
    <title>Gestionnaire de recherche d'emploi - Connexion</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>
    <h1>Gestionnaire de recherche d'emploi - Connexion</h1>
    <h2>Contrôle d'identité ! Vous devez vous connecter pour accéder à cette page !</h2>
    <form action="verify.php" method="post">
      <table>
        <tr style='border:0px;'>
          <td style='border:0px;'>
            <label for="username">&nbsp;Nom d'utilisateur :</label>
          </td>
          <td style='border:0px;'>
            <input type="text" name="username" required>
          </td>
        </tr>
        <tr style='border:0px;'>
          <td style='border:0px;'>
            <label for="password">&nbsp;Mot de passe :</label>
          </td>
          <td style='border:0px;'>
            <input type="password" name="password" required>
          </td>
        </tr>
      </table>
          <br>
          <input type="submit" value="Se connecter">
    </form><br><br>
    Si vous n'avez pas encore de compte, vous pouvez <a href="register.php">en créer un gratuitement</a> !<br>
    Si vous avez perdu vos identifiants, vous pouvez <a href="mailto:support@am-networks.fr">envoyer un mail à l'équipe support</a> en indiquant votre identifiant ainsi que vos noms et prénoms !
  </body>
</html>
