<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NadorCars | Voitures</title>
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

        table.table tr th,
        table.table tr td {
            padding: 7px 0px;
            text-align: center;
        }
    </style>
    <script src="../js/Cars.js"></script>
</head>

<body class="page white">

    <script>
        window.addEventListener("load", function () {
            const preloader = document.querySelector("#preloader");
            preloader.classList.add("hide");
        });
    </script>
    <?php include("header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <?php include("sidebarmenuCarExeption.php") ?>
            <div id="preloader">
                <div id="loader"></div>
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 AnimationIn"> <!--  her !!!!! Animation -->
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h2>Gestion <b>Voiture</b></h2>
                                </div>
                                <div class="col-sm-3">
                                    <form action="" method="post">

                                        <input type="text" id="client" class="form-control" name="client"
                                            placeholder="Recherche..." onkeyup="Recherche(this)">
                                    </form>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#addVoiture" class="btn btn-success" data-toggle="modal"><span><i
                                                class="fa-solid fa-plus"></i> <strong>Nouveau Voiture</strong>
                                        </span></a>
                                    <a href="ExportCars.php" class="btn btn-success"><span><i
                                                class="fa-solid fa-file-excel"></i><strong>vers Excel</strong></span></a>

                                </div>
                            </div>
                        </div>


                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <!-- <tr><span class="alert" style="color: <?php //echo $color; ?>;"></span>  -->
                                <tr>
                                    <th style='width: 200px;'>Matricule</th>
                                    <th>Marque</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                    <th>Observation</th>
                                    <th style="width: 10px; " colspan="2">Action</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody id="infomations">
                                <?php
                                if (!isset($_GET['info'])) {
                                    $rows_per_page = 8;
                                    $total_cars = count($Cars);
                                    $total_pages = ceil($total_cars / $rows_per_page);
                                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $start_row = ($current_page - 1) * $rows_per_page;
                                    $end_row = $start_row + $rows_per_page - 1;

                                    for ($i = $start_row; $i <= $end_row && $i < $total_cars; $i++) {
                                        $cr = $Cars[$i];
                                        echo
                                            "<tr onclick='get(this)'>
                                        <td style='width: 120px;word-break: break-all;'>$cr[0]</td>
                                        <td style='word-break: break-all;'>$cr[1]</td> 
                                        <td style='word-break: break-all;'>$cr[2]</td>
                                        <td style='width: 90px;word-break: break-all;'>$cr[3]</td> 
                                        <td style=' width: 300px;word-break: break-all;'>$cr[4]</td>
                                        <td><a  href='#editCar'  style='color:rgb(0, 119, 255);width: 20px'   data-toggle='modal'><i class='fa-sharp fa-solid fa-pen-to-square'></i></a></td>
                                        <td><a href='#deleteCar' style='color:rgb(255, 0, 0);width: 20px' data-toggle='modal'><i class='fa-solid fa-delete-left'></i></a></td>
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
                        <div class="<?php echo $class ?>" role="alert" id="message">
                            <?php echo $messege ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal HTML -->
            <div id="addVoiture" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post" id="form">
                            <div class="modal-header">
                                <h4 class="modal-title">Ajouter Voiture </h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Matricule</strong> </label>
                                    <input type="text" name="Matricule" class="form-control" required>
                                    <label><strong>Marque</strong></label>
                                    <input type="text" name="Marque" class="form-control" required>
                                    <label><strong>Model</strong></label>
                                    <input type="text" name="model" class="form-control" required>

                                    <label for="Type"><strong>Type</strong></label>
                                    <select name="Type" class="form-control">
                                        <option value="" selected disabled>Selectionnez Type de Voiture</option>
                                        <option value="Luxe">Luxe</option>
                                        <option value="Suv">Suv</option>
                                        <option value="Auto">Auto</option>
                                        <option value="Sedan">Sedan</option>
                                        <option value="Basique">Basique</option>
                                        <option value="compact">Compact</option>
                                    </select>
                                    <label><strong>Observation</strong></label>
                                    <textarea name="observation" row="5" col="60" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                                <input type="submit" name="add" class="btn btn-success" value="Ajouter">
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
                                <h4 class="modal-title">Modifier Voiture</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Matricule</strong> </label>
                                    <input type="text" name="Matricule" class="inputs form-control" required>
                                    <label><strong>Marque</strong> </label>
                                    <input type="text" name="Marque" class="inputs form-control" required>
                                    <label><strong>Model</strong> </label>
                                    <input type="text" name="model" class="inputs form-control" required>

                                    <label><strong>Type</strong></label>
                                    <select name="Type" class="inputs form-control">

                                        <option value="choisir" disabled>Selectionnez Type de Voiture</option>
                                        <option value="Compact">Compact</option>
                                        <option value="Luxe">Luxe</option>
                                        <option value="Suv">Suv</option>
                                        <option value="Auto">Auto</option>
                                        <option value="Sedav">Sedav</option>
                                        <option value="Basique">Basique</option>
                                    </select>
                                    <label><strong>Observation</strong> </label>
                                    <textarea name="observation" row="5" col="60"
                                        class="inputs form-control"></textarea>
                                </div>
                                <input type="hidden" id="OldMatricule" name="OldMatricule" class="inputs">
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
                            <input type="hidden" id="Matriculedelete" name="Matriculedelete" class="inputs">
                            <div class="modal-header">
                                <h4 class="modal-title">Supprimer Voiture</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
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