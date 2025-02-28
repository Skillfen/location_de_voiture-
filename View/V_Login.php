<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NadorCars | Login</title>
  <link rel="stylesheet" href="../Style/bootstrap.min.css">
  <link rel="stylesheet" href="../Style/Login.css">
  <link rel="stylesheet" href="../Style/bootstrap-5.2.0-dist/css/bootstrap.min.css">    
  <link rel="stylesheet" href="../Style/RealoadpageAnimation.css">


  <script src="../js/login.js"></script>

  

</head>
<body>
<div id="preloader">
                <div id="loader"></div>
  </div>
<form action="" method="post" id="form">

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h1 class="card-title text-center mb-5 fw-light fs-3 text-uppercase "><strong>Connexion</strong> </h1>
            <form>
              <div class="form-floating mb-3">
                <input value="<?= $login ?>" type="text" class="form-control" id="floatingInput" placeholder="Utilisateur" name="User" required>
                <label for="floatingInput">Utilisateur</label>
                <span style="color:red"><?= $erreurlogin ?></span>
                
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" value="<?= $password ?>" id="floatingPassword" placeholder="Mote de passe" name="Password" required>
                <label for="floatingPassword">Mote de passe</label>
                <span style="color:red"><?= $erreurpass ?></span>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="showPasswordCheckbox" name="" onclick="showPassword()">
                <label class="form-check-label" for="showPasswordCheckbox">
                  Afficher le mot de passe
                </label>
              </div>
              <div class="d-grid">
              <input type="submit"class="btn btn-primary btn-login text-uppercase fw-bold" value="Connexion" id="login" name="Connect"> 
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <form>
</body>
</html>
