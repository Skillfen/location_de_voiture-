<?php
require "../Model/M_Connexion.php";
require "../Model/IMethodeCRUD.php";

class Reservation extends Connexion implements IMethodeCRUD
{
    public $Id;

    public $Cin;
    public $Matricule;
    public $DateDebut;
    public $DateFin;
    public $prix;
    
    function __construct()
    {
    }
    public function Add()
{
    try {
        $this->connexion();
        $n = Connexion::$cnx->prepare("call SP_AddReservation(?,?,?,?,?)");
        $n->execute(array($this->Cin,
        $this->Matricule,
        $this->DateDebut
        ,$this->DateFin,$this->prix));
        $this->Deconnexion();
    } catch (PDOException $e) {
        if ($e->getCode() == "23000") {
            return false;
        } else {
            throw $e;
        }
    }
}


    public function Delete()
    {
        $n = null;
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_DeleteReservation(?)");
            $n->execute(array($this->Id));
            $this->Deconnexion();
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                return false;
            } else {
                throw $e;
            }
            }
    }
    
    public function Update()
    {
        $n = null;
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_UpdateReservation(?,?,?,?)");
            $n->execute(array($this->Id,$this->Cin,$this->DateFin,$this->prix));
            $this->Deconnexion();
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                return false;
            } else {
                throw $e;
            }
            }
    }

    public function GetAll()
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_GetReservation()")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
    public function GetLast_5()
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call GetLast_5()")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }

    // public function GetAllClients()
    // {
    //     $rows = [];
    //     try {
    //         $this->connexion();
    //         $rows = Connexion::$cnx->query("call SP_GetAllClientcin()")->fetchAll(PDO::FETCH_NUM);
    //         $this->Deconnexion();
    //     } catch (Exception $ex) {
    //     }
    //     return $rows;
    // }
    // public function GetAll_Cin()
    // {
    //     $rows = [];
    //     try {
    //         $this->connexion();
    //         $rows = Connexion::$cnx->query("call SP_GetCinNotInReservation()")->fetchAll(PDO::FETCH_NUM);
    //         $this->Deconnexion();
    //     } catch (Exception $ex) {
    //     }
    //     return $rows;
    // }

    public function Find($val)
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_FindReservation(\"$val\")")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
    
    public function Get_Client()
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_GetCin_NomByClient()")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
    
    public function Get_MarqueByType($type,$date1,$date2)
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_GetMarqueByType(\"$type\",\"$date1\",\"$date2\")")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
    

    public function Get_Type($date1,$date2)
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_GetType(\"$date1\",\"$date2\")")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
    public function Get_CarsByMarque($val,$date1,$date2)
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_GetVoitureByMarque('$val','$date1','$date2')")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
    public function VerifierDateFin($mat,$dtf)
    {
        $row = [];
        try {
            $this->connexion();
            $row = Connexion::$cnx->query("call SP_VerifierDateFin('$mat','$dtf')")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }
    public function GetDateFinById($id)
    {
        $row = [];
        try {
            $this->connexion();
            $row = Connexion::$cnx->query("call SP_GetDateFinById($id)")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $row;
    }



    public function GetInformationPDF($id)
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_GetInformationPDFbyReservation($id)")->fetch(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
}
?>