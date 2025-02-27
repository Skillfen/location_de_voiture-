
<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Clients.xls");

require "../Model/M_Connexion.php";
try {
    $cnx = new Connexion();
    $cnx->connexion();

    $stmt = Connexion::$cnx->query("SELECT * FROM  Client");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        echo "<table>";
        echo "<tr><th>Cin de Client</th><th>Nom de Client</th>
        <th>Prenom de Client</th><th>Nationalite</th>
        <th>Telephone</th><th>Permis</th></td><td>Observation</td></tr>";
        foreach ($rows as $row) {
            echo "<tr><th>".$row["Cin"].
            "</th><th>".$row["Nom"].
            "</th><th>".$row["Prenom"].
            "</th><th>".$row["Nationalite"].
            "</th><th>".$row["Telephone"].
            "</th><th>".$row["Permis"].
            "</th><th>".$row["Observation"].
            "</th></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$cnx->Deconnexion();
?>

