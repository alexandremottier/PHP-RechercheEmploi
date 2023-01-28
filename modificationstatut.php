<!DOCTYPE html>
<html>
<head>
    <title>Modification statut entretien</title>
</head>
<?php
include("class/sqlconnect.php");
?>
<body>
    <form action="modificationstatut.php" method="post">
        <label for="entreprise">Entreprise</label>
        <select name="entreprise" id="entreprise">
            <?php
                $sql = "SELECT ID, NomSociete FROM Entreprise";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<option value='" . $row['ID'] . "'>" . $row['NomSociete'] . "</option>";
                }
            ?>
        </select>
        <br>
        <label for="statut">Statut d'entretien</label>
        <select name="statut" id="statut">
            <?php
                $sql = "SELECT ID, Statut FROM StatutEntretien";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<option value='" . $row['ID'] . "'>" . $row['Statut'] . "</option>";
                }
            ?>
        </select>
        <br>
        <input type="submit" name="submit" value="Modifier statut">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $entreprise = $_POST['entreprise'];
            $statut = $_POST['statut'];

            $sql = "UPDATE Entreprise SET StatutEntretien = '$statut' WHERE ID = '$entreprise'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "Statut d'entretien mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour du statut d'entretien : " . mysqli_error($conn);
            }
        }
    ?>
</body>
</html>
