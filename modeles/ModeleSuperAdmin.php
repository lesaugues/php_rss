<?php

class ModeleSuperAdmin
{
    private $con;
    private $Visiteur;

    public function __construct()
    {
        global $dsn, $login, $mdp;
        $this->con=new Connection($dsn,$login, $mdp);
        $this->Visiteur=new VisiteurGateway($this->con);
    }

    public function connexion($login,$password)
    {
        $login=Validation::validString($login);
        $password=Validation::validString($password);
        $b = $this->Visiteur->checkSuperAdmin($login,$password);
        if($b==false)
        {
            return null;
        }
        else
        {
            $_SESSION['role'] = 'superAdmin';
            $_SESSION['login'] = 'login';
            return new Visiteur($login, $password, null, 'superAdmin');
        }
    }

    public static function deconnexion1()
    {
        session_unset();
        session_destroy();
        $_SESSION=array();
    }

    public static function isSuperAdmin()
    {
        if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role']=='superAdmin')
        {
            $login=Validation::validString($_SESSION['login']);
            $role=Validation::validString($_SESSION['role']);
            return new Visiteur($login,null,null,$role);
        }
        else
        {
            return null;
        }
    }
    public function ajouterAdmin($login,$password,$mail)
    {
        $login=Validation::validString($login);
        $password=Validation::validString($password);
        $mail=Validation::isEmail($mail);

        $this->Visiteur->ajoutUtil($login,$password,$mail);
        return true;
    }
    public function updatePassword($login,$oldPassword,$newPassword)
    {
        $login=Validation::validString($login);
        $oldPassword=Validation::validString($oldPassword);
        $newPassword=Validation::validString($newPassword);

        $check=$this->Visiteur->checkUser($login,$oldPassword);
        if($check!=true)
        {
            echo("Admin pas dans la base");
            return false;
        }
        else{
            $this->Visiteur->updateMDPUser($login,$newPassword);
            return true;
        }
    }

    public function deleteAdmin($login,$password)
    {
        $login=Validation::validString($login);
        $password=Validation::validString($password);
        $check=$this->Visiteur->checkUser($login,$password);
        if($check!=true)
        {
            echo("Admin pas dans la base");
            return false;
        }
        else{
            $this->Visiteur->deleteAdmin($login);
            return true;
        }
    }
}
?>