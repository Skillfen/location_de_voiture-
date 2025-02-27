<?php
require "../Model/M_Reservations.php";

session_start();
if (isset($_POST["btnDaconnecte"])) {
    session_unset();
    session_destroy();
    header("location:./Login");

}
if (!isset($_SESSION["Admin"]))
    header("location:./Login");


$ReservationObjet = new Reservation();

$messege = "";
function GetNbJours($dt1, $dt2)
{
    $date1 = new DateTime($dt1);
    $date2 = new DateTime($dt2);
    $interval = date_diff($date1, $date2);
    return $interval->format('%a');
}

if (isset($_POST["add"])) {
    $ReservationObjet->Cin = $_POST["Cin"];
    $ReservationObjet->Matricule = $_POST["Matricule"];
    $ReservationObjet->DateDebut = $_POST["DateDebut"];
    $ReservationObjet->DateFin = $_POST["DateFin"];
    $ReservationObjet->prix = $_POST["prix"];
    if ($_POST["Matricule"] != "choisir" ) // && $_POST["Cin"] != "choisir" 
    { 
        $n = $ReservationObjet->Add();
        if ($n !== false) {
            $messege = "Ajouté avec succès";
            $class = "alert alert-success";
        } else {
            $messege = "Cette Voiture avec la Matricule " . $_POST["Matricule"] . " En cours de reservation";
            $class = "alert alert-danger";        
            }
    } else {
        $messege = "Il faut choisir Matricule et CIN de Client";
        $class = "alert alert-warning";
    }
 
}
if (isset($_POST["update"])) {
 
    $ReservationObjet->Id = $_POST["ID"];
    $ReservationObjet->Cin = $_POST["Cin"];
    $ReservationObjet->DateFin = $_POST["datefinupdate"];
    $ReservationObjet->prix = $_POST["updateprix"];
    $n=$ReservationObjet->Update();
    if ($n !== false) {
        $messege = "Modifie avec succès";
        $class = "alert alert-success";
    } else {
        $messege = "Erreur";
        $class = "alert alert-danger";
    }

}
if (isset($_POST["delete"])) {
    $ReservationObjet->Id = $_POST["ID"];
    $n = $ReservationObjet->Delete();
     if ($n !== false) {
        $messege = "Supprime avec succès";
        $class = "alert alert-success";

    } else {
        $messege = "Erreur";
        $class = "alert alert-danger";
    }}


if (isset($_POST['marque']) && isset($_POST['dt1']) && isset($_POST['dt2'])) {
    $Liste_Voitures = $ReservationObjet->Get_CarsByMarque($_POST['marque'], $_POST['dt1'], $_POST['dt2']);
    print_r($Liste_Voitures);
    echo "<option value='choisir'>choisir Voiture</option>";
    foreach ($Liste_Voitures as $voiture) {
        echo "<option value='$voiture[0]'>$voiture[0] | $voiture[2] | $voiture[3] | $voiture[4]</option>";
    }


} elseif (isset($_POST['type']) && isset($_POST['dt1']) && isset($_POST['dt2'])) {
    $Liste_marque = $ReservationObjet->Get_MarqueByType($_POST['type'], $_POST['dt1'], $_POST['dt2']);
    print_r($Liste_marque);
    echo "<option value='choisir'>choisir Marque</option>";
    foreach ($Liste_marque as $marque) {
        echo "<option value='$marque[0]'>$marque[0]</option>";
    }


} elseif (isset($_POST['dt1']) && isset($_POST['dt2'])) {
    $Liste_Type = $ReservationObjet->Get_Type($_POST['dt1'], $_POST['dt2']);
    echo "<option value='choisir'>choisir Type</option>";
    foreach ($Liste_Type as $Type) {
        echo "<option value='$Type[0]'>$Type[0]</option>";
    }
} 
elseif (isset($_POST['datefinupdate']) && isset($_POST['matupdate']) && isset($_POST['Id'])) {
    $dateFinPrecedent = $ReservationObjet->GetDateFinById($_POST['Id']);
    // echo $dateFinPrecedent[0][0];
    $dtd = $ReservationObjet->VerifierDateFin($_POST['matupdate'],$dateFinPrecedent[0][0]);
   
    if (count($dtd) != 0){
        if($dtd[0][0] >= $_POST['datefinupdate']){
            echo $_POST['datefinupdate'];
        }else{
            
            echo $dtd[0][0];
        }
    }else{
    echo $_POST['datefinupdate'];
    }
    
} elseif (isset($_GET['info'])) {
    $info = $_GET['info'];
    if ($info == "") {
        $Reservation = $ReservationObjet->GetAll();
    } else {
        $Reservation = $ReservationObjet->Find($info);
    }

    foreach ($ReservationObjet as $Reser) {
        echo "<tr onclick='get(this)>
                        <td>$Reser[0]</td>
                        <td>$Reser[1]</td>  
                        <td>$Reser[2]</td>  
                        <td>$Reser[3]</td> 
                        <td>$Reser[4]</td> 
                    </tr>";
    }



} else {
    $Reservation = $ReservationObjet->GetAll();
    $Liste_Client = $ReservationObjet->Get_Client();

    require "../View/V_Reservations.php";
}
?>