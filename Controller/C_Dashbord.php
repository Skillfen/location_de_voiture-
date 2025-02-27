<?php
session_start();
if (isset($_POST["btnDaconnecte"])){
    session_unset();
    session_destroy();
    header("location:./Login");

}
if (!isset($_SESSION["Admin"]))
    header("location:./Login");

$conn = mysqli_connect("localhost", "root", "", "NadorCars");
$sqlnbCars = "SELECT COUNT(*) as countnbCars FROM Cars";
$resultnbCars = mysqli_query($conn, $sqlnbCars);
        if ($resultnbCars && mysqli_num_rows($resultnbCars) > 0) {
            $row = mysqli_fetch_assoc($resultnbCars);
            $nbCars = $row['countnbCars'];
        } else {
            $nbCars = 0;
        }
        
$sqlnbClient= "SELECT COUNT(*) as countnbClient FROM Client";
$resultnbClient = mysqli_query($conn, $sqlnbClient);

        if ($resultnbCars && mysqli_num_rows($resultnbClient) > 0) {
            $row = mysqli_fetch_assoc($resultnbClient);
            $nbClient = $row['countnbClient'];
        } else {
            $nbClient = 0;
        }
        
$sqlReservation= "SELECT Cars.Matricule, COUNT(*) AS countReservation
FROM Cars
INNER JOIN Reservation ON Cars.Matricule = Reservation.Matricule ";
$resultReservation = mysqli_query($conn, $sqlReservation);
        if ($resultReservation && mysqli_num_rows($resultReservation) > 0) {
            $row = mysqli_fetch_assoc($resultReservation);
            $nbReservation = $row['countReservation'];
        } else {
            $nbReservation = 0;
        }
        
$sqlVoitureDisponible= "SELECT COUNT(*) AS VoitureDisponible
FROM Cars
LEFT JOIN Reservation ON Cars.Matricule = Reservation.Matricule
WHERE Reservation.Matricule IS NULL; ";
$resultVoitureDisponible = mysqli_query($conn, $sqlVoitureDisponible);
        if ($resultVoitureDisponible && mysqli_num_rows($resultVoitureDisponible) > 0) {
            $row = mysqli_fetch_assoc($resultVoitureDisponible);
            $nbVoitureDisponible = $row['VoitureDisponible'];
        } else {
            $nbVoitureDisponible = 0;
        }

$sql = "SELECT c.Model, SUM(DATEDIFF(r.DateFin, r.DateDebut) * r.prix) AS earnings
        FROM Reservation r
        INNER JOIN Cars c ON r.Matricule = c.Matricule
        GROUP BY c.Model;";
        
        $result = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

require "../View/V_Home.php";
?>