<html>
<head>
    <title>Ajouter un contact</title>
    <link href="custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <h1>Ajouter un contact</h1>
<?php
    include 'class/sqlconnect.php';

    if(isset($_POST['submit'])){
        $prenom = $_POST['Prenom'];
        $nom = $_POST['Nom'];
        $poste = $_POST['Poste'];
        $mobile = $_POST['Mobile'];
        $entreprise = $_POST['IDEntreprise'];

        $sql = "INSERT INTO Contact (Prenom, Nom, Poste, Mobile, IDEntreprise) VALUES ('$prenom', '$nom', '$poste', '$mobile', '$entreprise')";
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
        <label for="Mobile">Numéro de mobile :</label>
      </td>
      <td>
        <input type="text" name="Mobile" >
      </td>
    </tr>
    <tr>
      <td>
        <label for="Entreprise">Entreprise :</label>
      </td>
      <td>
        <select name="IDEntreprise">
            <?php
                $sql = "SELECT ID, NomSociete FROM Entreprise";
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
