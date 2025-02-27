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

}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NadorCars | Reservations</title>
    <link rel="stylesheet" href="../Style/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/All.css">
    <link rel="stylesheet" href="../Style/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <script src="../Style/jquery.min.js"></script>
    <script src="../Style/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../Style/fontawesome-free-6.3.0-web/css/all.css">   
    <link rel="stylesheet" href="../Style/RealoadpageAnimation.css">

    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        table {
            word-wrap: break-word;
        }

        table.table.tr th,
        table.table tr td {
            padding: 7px 0px;
            text-align: center;
        }
    </style>
    <script src="../js/Reservation.js"></script>
    <script>
        window.addEventListener("load", function () {
            const preloader = document.querySelector("#preloader");
            preloader.classList.add("hide");
        });
    </script>
</head>

<body>
    <?php include("../View/header.php") ?>

    <div id="preloader">
                <div id="loader"></div>
            </div>
    <div class="container-fluid">
    
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"
                                style="color: #3384ff;">
                                <i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;
                                <i class="fa-solid fa-file-contract"></i> &nbsp;&nbsp; Reservations
                            </a>
                        </li><br><br>
                    </ul>

                </div>
            </nav>
            
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h2>Gestion <b>Reservations</b></h2>
                                </div>
                                <div class="col-sm-3">
                                    <!-- <form action="" method="post">
                                        <input type="text" id="client" class="form-control" name="client"
                                            placeholder="Recherche..." onkeyup="Recherche(this)">
                                    </form> -->
                                </div>
                                <div class="col-sm-4">
                                    <a href="#addReservation" class="btn btn-success" data-toggle="modal"><span><i
                                                class="fa-solid fa-plus"></i> <strong>Nouvelle Reservation</strong>
                                        </span></a>
                                    <a href="ExportReservation.php" class="btn btn-success"><span><i
                                                class="fa-solid fa-file-excel"></i><strong>Export
                                                Excel</strong></span></a>

                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered 20px">
                            <thead>
                                <tr>
                                    <span id="message" class="alert" style="color: <?php echo $color; ?>;"><?php echo $messege ?></span>
                                <tr>
                                <tr>
                                    <th>&nbsp;#ID</th>
                                    <th>&nbsp;&nbsp;Cin Client</th>
                                    <th>Matricule</thtyle=>
                                    <th>De </th=>
                                    <th>à</th>
                                    <th>Prix/jour(DH)</th>
                                    <th>Nombre Jours</th>
                                    <th>Totale(DH)</th>
                                    <th>Status</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody id="infomations">
                                <?php
                                if (!isset($_GET['info'])) {
                                    $status = "";

                                    $rows_per_page = 8;
                                    $total_reservations = count($Reservation);
                                    $total_pages = ceil($total_reservations / $rows_per_page);
                                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $start_row = ($current_page - 1) * $rows_per_page;
                                    $end_row = $start_row + $rows_per_page - 1;
                                    for ($i = $start_row; $i <= $end_row && $i < $total_reservations; $i++) {
                                        $Reser = $Reservation[$i];
                                        $timestamp1 = strtotime($Reser[4]);
                                        $timestamp2 = strtotime(date("Y-m-d"));
                                        if ($timestamp2 > $timestamp1) {
                                            $status = "Terminé";
                                            $color = "red";
                                        } else {
                                            $status = "En cours";
                                            $color = "green";
                                        }
                                        echo "<tr onclick='get(this)'>
                                        <td style='word-break: break-all;'>$Reser[0]</td>
                                        <td style='word-break: break-all;'>$Reser[1]</td> 
                                        <td style='word-break: break-all;'>$Reser[2]</td>
                                        <td style='word-break: break-all;'>$Reser[3]</td> 
                                        <td style='word-break: break-all;'><strong>$Reser[4]</strong></td>
                                        <td style='word-break: break-all;'>$Reser[5]</td>
                                        <td>" . GetNbJours($Reser[3], $Reser[4]) . "</td>
                                        <td>" . GetNbJours($Reser[3], $Reser[4]) * $Reser[5] . "</td>
                                        <td style='color: $color;'><strong>$status</strong></td>
                                        <td><a href='#editCar' style='color:rgb(0, 119, 255)' data-toggle='modal'><i class='fa-sharp fa-solid fa-pen-to-square'></i></a></td>
                                        <td><a href='#deleteCar' style='color:rgb(255, 0, 0)' data-toggle='modal'><i class='fa-solid fa-delete-left'></i></a></td>
                                    </tr>";
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                        <?php
                        echo "<div class='pagination'>";
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $current_page) {
                                echo "<strong>$i</strong> ";
                            } else {
                                echo "<a href='?page=$i'>$i</a> ";
                            }
                        }
                        echo "</div>";
                        ?>

                    </div>
                </div>
            </div>
            <!-- Add Modal HTML -->
            <div id="addReservation" class="modal fade" style="Overflow-Y:hidden">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Ajouter un Reservation </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <form action="Espace_Utilisateur_Reservations" method="post" id="form">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Client</strong> </label>
                                            <select name="Cin" id="" class="form-control" style="width: 218%">
                                                <option value="VIDE">VIDE</option>
                                                <?php foreach ($Liste_Client as $client): ?>
                                                    <?php if ($client[0] != "VIDE"): ?>
                                                        <option value="<?= $client[0] ?>"><?= $client[0] ?> - <?= $client[1] ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>

                                            <label><strong>De </strong></label>
                                            <input type="Date" name="DateDebut" onchange="ChangeDates()" id="DateDebut"
                                                class="form-control" required>

                                            <label><strong>à</strong></label>
                                            <input type="Date" name="DateFin" onchange="ChangeDates()" id="DateFin"
                                                class="form-control" required>

                                            <label><strong>Type</strong></label>
                                            <select id="Type" class="form-control" onchange="ChangeType()" required>
                                                <option value="choisir">Choisir Type</option>
                                            </select>
                                            <label><strong>Marque</strong></label>
                                            <select id="marque" class="form-control" style="width: 218%"
                                                onchange="ChangeMarque()" required>
                                                <option value="choisir">Choisir Marque</option>
                                            </select>
                                            <label><strong>Voiture</strong></label>
                                            <select name="Matricule" id="select_voiture" style="width: 218%"
                                                class="form-control" required>
                                                <option value="choisir">Choisir Voiture</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="position: relative;top: 68px; height: 100px;">
                                        <label><strong>Nombre de Jour</strong></label>
                                        <input type="text" id="nbj" value="0" class="form-control" disabled>

                                        <label><strong>Prix par jour</strong></label>
                                        <input type="text" name="prix" onkeyup="ChangePrix()" id="prix"
                                            class="form-control" required>

                                        <label><strong>Total </strong></label>
                                        <input type="text" value="0" id="total" class="form-control" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                                <input type="submit" name="add" class="btn btn-success" value="Ajouter">
                            </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="editCar" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post" id="form">
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier Reservation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group ">
                                <input type="hidden" id="ID" name="ID" class="inputs">
                                <label><strong>Client</strong> </label>
                                <select name="Cin" id="" class=" inputs form-control">
                                    <option value="choisir">Choisir Client</option>
                                    <option value="VIDE">VIDE</option>
                                    <?php foreach ($Liste_Client as $client): ?>
                                        <option value="<?= $client[0] ?>"><?= $client[0] ?> - <?= $client[1] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label><strong>Matricule</strong> </label>
                                        <input type="text" id="matriculeupdate" class="inputs form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>De</strong> </label>
                                        <input type="text" class="inputs form-control" id="datedebutupdate" disabled>
                                    </div>
                                </div>
                                <label><strong>à</strong> </label>
                                <input type="date" name="datefinupdate" id="datefinupdate" onchange="UpdateDateFin()"
                                    class="inputs form-control" required>
                                <label><strong>Prix par jour</strong> </label>
                                <input type="text" name="updateprix" id="updateprix" onkeyup="UpdatePrix()"
                                    class="inputs form-control" required>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label><strong>Nombre Jours</strong> </label>
                                        <input type="text" id="nbjourupdate" class="inputs form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>Total</strong> </label>
                                        <input type="text" id="totalupdate" class="inputs form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                            <input type="submit" name="update" class="btn btn-success" value="Sauvgarder">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteCar" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post" id="form">
                        <input type="hidden" id="ID" name="ID" class="inputs">
                        <div class="modal-header">
                            <h4 class="modal-title">Supprimer Reservation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir supprimer ces enregistrement?</p>
                            <p class="text-warning"><small>Cette c ne peux pas être annulée.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                            <input type="submit" name="delete" class="btn btn-danger" value="Supprimer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>


</html>