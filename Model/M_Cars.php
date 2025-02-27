<?php
require "../Model/M_Connexion.php";
require "../Model/IMethodeCRUD.php";

class Cars extends Connexion implements IMethodeCRUD
{
    public $NewMatricule;
    public $OldMatricule;
    public $Marque;
    public $model;
    public $Type;
    public $observation;
    
    function __construct()
    {
    }

    public function Add()
    {
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_AddCars(?,?,?,?,?)");
            $n->execute(array($this->NewMatricule,$this->Marque,$this->model,$this->Type,$this->observation));
            $this->Deconnexion();
            return $n;
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
            $n = Connexion::$cnx->prepare("call SP_UpdateCars(?,?,?,?,?,?)");
            $n->execute(array($this->OldMatricule,$this->NewMatricule,$this->Marque,$this->model,$this->Type,$this->observation));
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
            $n = Connexion::$cnx->prepare("call SP_DeleteCars(?)");
            $n->execute(array($this->NewMatricule));
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
            $rows = Connexion::$cnx->query("call SP_GetAllCars()")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }

    public function Find($val)
    {
        $rows = [];
        try {
            $this->connexion();
            $rows = Connexion::$cnx->query("call SP_FindCars(\"$val\")")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
}
?>