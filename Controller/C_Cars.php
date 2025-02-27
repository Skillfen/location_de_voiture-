<?php
require "../Model/M_Cars.php";
session_start();
if (isset($_POST["btnDaconnecte"])){
    session_unset();
    session_destroy();
    header("location:./Login");

}
if (!isset($_SESSION["Admin"]))
    header("location:./Login");


$Cars = new Cars();

$messege = "";



if (isset($_POST["add"])) {
    $Cars->NewMatricule = $_POST["Matricule"];
    $Cars->Marque = $_POST["Marque"];
    $Cars->model = $_POST["model"];
    $Cars->observation = $_POST["observation"];
    if (isset($_POST["Type"])) {
        $Cars->Type = $_POST["Type"];
        $n = $Cars->Add();
        if ($n !== false) {
            $messege = "Ajouté avec succès";
            $class = "alert alert-success";
        } else {
            $messege = "Cette Voiture avec la Matricule ".$_POST["Matricule"]." existe déjà";
            $class = "alert alert-danger";
        }
    } else {
        $messege = "Il faut choisir le type de Voiture";
        $class = "alert alert-warning";
    }
}
if (isset($_POST["update"])) {
    $Cars->NewMatricule = $_POST["Matricule"];
    $Cars->Marque = $_POST["Marque"];
    $Cars->model = $_POST["model"];
    $Cars->Type = $_POST["Type"];
    $Cars->observation = $_POST["observation"];
    $Cars->OldMatricule = $_POST["OldMatricule"];
    $n = $Cars->Update();
    if ($n !== false) {
        $messege = "Modifie avec succès";
        $class = "alert alert-success";

    } else {
        $messege = "Cette Voiture avec la Matricule ".$_POST["Matricule"]." existe déjà";
        $class = "alert alert-danger";

    }

}


if (isset($_POST["delete"])) {
    $Cars->NewMatricule = $_POST["Matriculedelete"];
    $n = $Cars->Delete();
    if ($n !== false) {
        $messege = "Supprime avec succès";
        $class = "alert alert-success";

    } else {
        $messege = "Cette Voiture Deja en Reservation";
        $class = "alert alert-danger";

    }
}


if (isset($_GET['info'])) {
    $info = $_GET['info'];
    if ($info == "") {
        $Cars = $Cars->GetAll();
    } else {
        $Cars = $Cars->Find($info);

    }

    foreach ($Cars as $cr) {
        echo    "<tr onclick='get(this)'>
                    <td>$cr[0]</td> 
                    <td>$cr[1]</td>  
                    <td>$cr[2]</td>  
                    <td>$cr[3]</td> 
                    <td>$cr[4]</td> 
                    <td><a href='#editCar'  style='color:rgb(0, 119, 255)'   data-toggle='modal'><i class='fa-sharp fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='#deleteCar' style='color:rgb(255, 0, 0)' data-toggle='modal'><i class='fa-solid fa-delete-left'></i></a></td>
                </tr>";
                //<!-- <td>$cr[4]</td> -->
    }
} else {
    $Cars = $Cars->GetAll();
    require "../View/V_Cars.php";
}
?>