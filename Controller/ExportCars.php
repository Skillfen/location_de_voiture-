
<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Voitures.xls");
require "../Model/M_Connexion.php";
try {
    $cnx = new Connexion();
    $cnx->connexion();
    $stmt = Connexion::$cnx->query("SELECT * FROM  Cars");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($rows) > 0) {
        echo "<table>";
        echo "<tr><th>Matricule De Voiture</th><th>La Marque</th>
        <th>Model de voiture</th><th>Type</th>
        <th>Observation</th></tr>";
        foreach ($rows as $row) {
            echo "<tr><th>".$row["Matricule"].
            "</th><th>".$row["Marque"].
            "</th><th>".$row["model"].
            "</th><th>".$row["type"].
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

