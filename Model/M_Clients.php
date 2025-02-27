<?php
require "../Model/M_Connexion.php";
require "../Model/IMethodeCRUD.php";

class Client extends Connexion implements IMethodeCRUD
{
    public $NewCin;
    public $OldCin;
    public $Nom;
    public $Prenom;
    public $Nationalite;
    public $Telephone;
    public $Permis;
    public $observation;
    
    function __construct()
    {
    }

    public function Add()
    {
        $n = null;
        try {
            $this->connexion();
            $n = Connexion::$cnx->prepare("call SP_AddClient(?,?,?,?,?,?,?)");
            $n->execute(array($this->NewCin,$this->Nom,$this->Prenom,$this->Nationalite,$this->Telephone,$this->Permis,$this->observation));
            $this->Deconnexion();
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                // Duplicate entry for CIN
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
            $n = Connexion::$cnx->prepare("call SP_UpdateClient(?,?,?,?,?,?,?,?)");
            $n->execute(array($this->OldCin,$this->NewCin,$this->Nom,$this->Prenom,$this->Nationalite,$this->Telephone,$this->Permis,$this->observation));
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
            $n = Connexion::$cnx->prepare("call SP_DeleteClient(?)");
            $n->execute(array($this->NewCin));
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
            $rows = Connexion::$cnx->query("call SP_GetAllClient()")->fetchAll(PDO::FETCH_NUM);
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
            $rows = Connexion::$cnx->query("call SP_FindClient(\"$val\")")->fetchAll(PDO::FETCH_NUM);
            $this->Deconnexion();
        } catch (Exception $ex) {
        }
        return $rows;
    }
}
