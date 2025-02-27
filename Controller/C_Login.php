<?php
require "../Model/M_Connexion.php";
$login = "Admin";
$password = "Admin";
$erreurlogin = "";
$erreurpass = "";
if (isset($_POST["Connect"])){
    $login = $_POST["User"];
    $password = $_POST["Password"];
    if (!empty($login) and !empty($password)){
        $cnxx = new Connexion();
        $cnxx->connexion();
        $st = $cnxx::$cnx->prepare("select Login,MotPass from admin where Login = :login");
        $st->bindParam(":login",$login);
        $st->execute();
        $Admin = $st->fetch(); 
        if ($Admin){
            if (password_verify($password,$Admin[1])){
                session_start();
                $_SESSION["Admin"] = $Admin;

                    header("Location:Dashbord");
            } else {
                $erreurpass = "Mote de passe incorrect";
            }
        } else {
            $erreurlogin = "Utilisateur incorrect";
        }
        $cnxx->Deconnexion(); 
    }
}
require "../View/V_Login.php";
//echo password_hash("Admin",PASSWORD_DEFAULT)
?>
