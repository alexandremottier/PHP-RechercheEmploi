<html>
<head>
    <title>Ajouter un contact</title>
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

<form method="post" action="">
    <label for="Prenom">Prénom :</label>
    <input type="text" name="Prenom" required>
    <br>
    <label for="Nom">Nom :</label>
    <input type="text" name="Nom" required>
    <br>
    <label for="Poste">Poste occupé :</label>
    <input type="text" name="Poste" >
    <br>
    <label for="Mobile">Numéro de mobile :</label>
    <input type="text" name="Mobile" >
    <br>
    <label for="Entreprise">Entreprise :</label>
    <select name="IDEntreprise">
        <?php
            $sql = "SELECT ID, NomSociete FROM Entreprise";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value='" . $row['ID'] . "'>" . $row['NomSociete'] . "</option>";
            }
        ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Ajouter">
</form>
