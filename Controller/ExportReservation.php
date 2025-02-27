
<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reservations.xls");

require "../Model/M_Connexion.php";
try {
    
    $cnx = new Connexion();
    $cnx->connexion();
    // $stmt = Connexion::$cnx->query("SELECT * FROM  Reservation");

    $stmt = Connexion::$cnx->query("SELECT distinct c.*, car.*,r.*, DATEDIFF(r.DateFin, r.DateDebut) * r.prix AS Total FROM 
    Client c
    JOIN Reservation r ON r.Cin = c.Cin
    JOIN Cars car ON r.Matricule = car.Matricule");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        echo "<table>";
        echo "<tr><th>ID de Reservation</th>
        <th>Nom de Client</th>
        <th>Prenom de Client</th>
        <th>Cin de Client</th>
        <th>Matricule de voiture</th>
        <th>Marque de voiture </th>
        <th>Model</th>
        <th>DateDebut</th>
        <th>DateFin</th>
        <th>Prix par le jour</th>
        <th>Total a payer</th></tr>";
        foreach ($rows as $row) {
            echo "<tr><th>".$row["id"].
            "</th><th>".$row["Nom"].
            "</th><th>".$row["Prenom"].
            "</th><th>".$row["Cin"].
            "</th><th>".$row["Matricule"].
            "</th><th>".$row["Marque"].
            "</th><th>".$row["model"].
            "</th><th>".$row["DateDebut"].
            "</th><th>".$row["DateFin"].
            "</th><th>".$row["prix"].
            "</th><th>".$row["Total"].
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

