<?php
require "../Model/M_Clients.php";
session_start();
if (isset($_POST["btnDaconnecte"])) {
    session_unset();
    session_destroy();
    header("location:./Login");
}
if (!isset($_SESSION["Admin"]))
    header("location:./Login");

$client = new Client();
$messege = "";
if (isset($_POST["add"])) {
    $client->NewCin = $_POST["cin"];
    $client->Nom = $_POST["nom"];
    $client->Prenom = $_POST["prenom"];
    $client->Nationalite = $_POST["nationalite"];
    $client->Telephone = $_POST["telephone"];
    $client->Permis = $_POST["permis"];
    $client->observation = $_POST["observation"];
    $n = $client->Add();
    if ($n !== false) {
        $messege = "Ajouté avec succès";
        $class = "alert alert-success";
    } else {
        $messege = "Cette Client avec Cin " . $_POST["cin"] . " existe déjà";
        $class = "alert alert-danger";
    }
}

if (isset($_POST["update"])) {
    $client->NewCin = $_POST["cin"];
    $client->Nom = $_POST["nom"];
    $client->Prenom = $_POST["prenom"];
    $client->Nationalite = $_POST["nationalite"];
    $client->Telephone = $_POST["telephone"];
    $client->Permis = $_POST["permis"];
    $client->observation = $_POST["observation"];
    $client->OldCin = $_POST["oldcin"];
    $n = $client->Update();
    if ($n !== false) {
        $messege = "Modifie avec succès";
        $class = "alert alert-success";

    } else {
        $messege = "Virefy les information";
        $class = "alert alert-danger";
    }
}


if (isset($_POST["delete"])) {
    $client->NewCin = $_POST["cindelete"];
    $n = $client->Delete();
    if ($n !== false) {
        $messege = "Supprime avec succès";
        $class = "alert alert-success";

    } else {
        $messege = "Ce Client Deja en Reservation";
        $class = "alert alert-danger";
    }
}


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    if ($info == "") {
        $Clinets = $client->GetAll();
    } else {
        $Clinets = $client->Find($info);
    }

    foreach ($Clinets as $cl) {
        if ($cl[0] != "VIDE") {
            echo    "<tr onclick='get(this)'>
                    <td>$cl[0]</td>
                    <td>$cl[1]</td>  
                    <td>$cl[2]</td>  
                    <td>$cl[3]</td> 
                    <td>$cl[4]</td> 
                    <td>$cl[5]</td> 
                    <td>$cl[6]</td>
                    <td><a href='#editClient' style='color:rgb(0, 119, 255)'    data-toggle='modal'><i class='fa-sharp fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='#deleteClinet' style='color:rgb(255, 0, 0)' data-toggle='modal'><i class='fa-solid fa-delete-left'></i></a></td>
                </tr>";
        }
    }
} else {
    $Clients = $client->GetAll();
    require "../View/V_Clients.php";
}
?>