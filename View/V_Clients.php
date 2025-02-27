<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NadorCars | Client</title>
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
</head>
<script src="../js/Clients.js"></script>
<body>
<?php include("header.php") ?>
    <div class="container-fluid">
    <script>
        window.addEventListener("load", function () {
            const preloader = document.querySelector("#preloader");
            preloader.classList.add("hide");
        });
    </script>
        <div class="row">
        <?php include("SideBarMenu.php") ?>
        <div id="preloader">
                <div id="loader"></div>
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 AnimationIn">

                <div class="table-responsive ">
                    <div class="table-wrapper">

                        <div class="table-title">

                            <div class="row">
                                <div class="col-sm-5">
                                    <h2>Gestion <b>Clients</b></h2>
                                </div>
                                <div class="col-sm-3">
                                    <form action="" method="post">
                                        <input type="text" id="client" class="form-control" name="client"
                                            placeholder="Recherche..." onkeyup="Recherche(this)">
                                    </form>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#addVoiture" class="btn btn-success " data-toggle="modal"><span><i
                                                class="fa-solid fa-plus"></i><strong>Nouveau Client</strong>
                                        </span></a>
                                    <a href="ExportClient.php" class="btn btn-success"><span><i
                                                class="fa-solid fa-file-excel"></i><strong>vers Excel</strong></span></a>
                                </div>
                            </div>
                        </div>
                        
                        <table class="table table-striped table-hover  table-bordered">
                            <thead >
                                <tr>
                                    <th style='width: 100px'>Cin</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Nationalite</th>
                                    <th style='width: 100px'>Telephone</th>
                                    <th>Permis</th>
                                    <th style="width: 200px ;">Observation</th>
                                    <th style="width: 40px; position: relative;right: 10px;" colspan="2" >Action</th>
                                </tr>
                                
                            </thead>
                            <tbody  id="infomations">
                                <?php
                                $rows_per_page = 8;
                                $total_clients = count($Clients);
                                $total_pages = ceil($total_clients / $rows_per_page);
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $start_row = ($current_page - 1) * $rows_per_page;
                                $end_row = $start_row + $rows_per_page - 1;

                                if (!isset($_GET['info'])) {
                                    for ($i = $start_row; $i <= $end_row && $i < $total_clients; $i++) {
                                        $cl = $Clients[$i];
                                        if ($cl[0] != "VIDE") {
                                            echo "<tr onclick='get(this)'>
                                        <td word-break: break-all;'>$cl[0]</td>
                                        <td word-break: break-all;'>$cl[1]</td> 
                                        <td word-break: break-all;'>$cl[2]</td>
                                        <td word-break: break-all;'>$cl[3]</td> 
                                        <td word-break: break-all;'>$cl[4]</td>
                                        <td word-break: break-all;'>$cl[5]</td> 
                                        <td style='width: 100px;word-break: break-all;'>$cl[6]</td>
                                        <td><a href='#editClient' style='color:rgb(0, 119, 255)' data-toggle='modal'><i class='fa-sharp fa-solid fa-pen-to-square'></i></a></td>
                                        <td><a href='#deleteClinet' style='color:rgb(255, 0, 0)' data-toggle='modal'><i class='fa-solid fa-delete-left'></i></a></td>
                                      </tr>";
                                        }
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
                        <div class="<?php echo $class ?>" role="alert" id="message" >
                            <?php echo $messege ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal HTML -->
            <div id="addVoiture" class="modal fade" style="overflow-y:hidden;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post" id="form">
                            <div class="modal-header">
                                <h4 class="modal-title ">Ajouter Un Client</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>CIN</strong></label>
                                    <input type="text" name="cin" class="form-control" required>

                                    <label><strong>Nom</strong></label>
                                    <input type="text" name="nom" class="form-control" required>

                                    <label><strong>Prénom</strong></label>
                                    <input type="text" name="prenom" class="form-control" required>

                                    <label><strong>Nationalité</strong></label>
                                    <input type="text" name="nationalite" class="form-control" value="Marocaine"
                                        required>

                                    <div class="row">
                                        <div class="col">
                                            <label><strong>Téléphone</strong></label>
                                            <input type="text" name="telephone" class="form-control" required>
                                        </div>
                                        <div class="col">
                                            <label><strong>Permis</strong></label>
                                            <input type="text" name="permis" class="form-control" required>
                                        </div>
                                    </div>

                                    <label><strong>Observation</strong></label>
                                    <textarea name="observation" class="form-control"></textarea>
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
            <div id="editClient" class="modal fade" style="overflow-y:hidden;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post" id="form">
                            <div class="modal-header">
                                <h4 class="modal-title">Modifier Client</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>CIN</strong></label>
                                    <input type="text" name="cin" class="inputs form-control" required>
                                    <label><strong>Nom</strong></label>
                                    <input type="text" name="nom" class="inputs form-control" required>
                                    <label><strong>Prénom</strong></label>
                                    <input type="text" name="prenom" class="inputs form-control" required>
                                    <label><strong>Nationalité</strong></label>
                                    <input type="text" name="nationalite" class="inputs form-control" required>
                                    <div class="form-row">
                                        <div class="col">
                                            <label><strong>Téléphone</strong></label>
                                            <input type="text" name="telephone" class="inputs form-control" required>
                                        </div>
                                        <div class="col">
                                            <label><strong>Permis</strong></label>
                                            <input type="text" name="permis" class="inputs form-control" required>
                                        </div>
                                    </div>
                                    <label><strong>Observation</strong></label>
                                    <textarea name="observation" row="5" col="60"
                                        class="inputs form-control"></textarea>
                                </div>
                                <input type="hidden" id="oldcin" name="oldcin" class="inputs">
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
            <div id="deleteClinet" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post" id="form">
                            <input type="hidden" id="cindelete" name="cindelete" class="inputs">
                            <div class="modal-header">
                                <h4 class="modal-title">Supprimer Client</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir supprimer ces enregistrement?</p>
                                <p class="text-warning"><small>Cette action ne peux pas être annulée.</small></p>
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