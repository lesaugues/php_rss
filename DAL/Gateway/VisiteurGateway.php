<?php

require_once(__DIR__.'/../Visiteur.php');

class VisiteurGateway
{
    private $con;

    public function __construct($con)
    {
        $this->con=$con;
    }

    public function checkUser($login,$password)
    {
        $query="SELECT * FROM visiteur WHERE login=:login AND role='admin'";
        $this->con->executeQuery($query,array(':login'=>array($login,PDO::PARAM_STR)));
        $result=$this->con->getResults();

        if(isset($result) && password_verify($password,$result[0]['password']))
        {
            return true;
        }
        else
        {
            echo("Connexion échoué");
            return false;
        }
    }

    public function checkSuperAdmin($login,$password)
    {
        $query="SELECT * FROM visiteur WHERE login=:login AND role='superAdmin'";
        $this->con->executeQuery($query,array(':login'=>array($login,PDO::PARAM_STR)));
        $result=$this->con->getResults();
        if(isset($result) && password_verify($password,$result[0][2]))
        {
            return true;
        }
        else
        {
            echo("Connexion échoué");
            return false;
        }
    }

    public function updateMDPUser($login,$password)
    {
        $newPass=password_hash($password,PASSWORD_DEFAULT);
        $query="UPDATE visiteur SET password=:password WHERE login=:login";
        $this->con->executeQuery($query,array(':password' => array($newPass,PDO::PARAM_STR),':login' => array($login,PDO::PARAM_STR)));
    }

    public function allUser()
    {
        $query="SELECT * FROM visiteur";
        $this->con->executeQuery($query,array());

        return $this->con->getResults();
    }

    public function passHash()
    {
        $tabAllUser=$this->allUser();
        if(isset($tabAllUser))
        {
            foreach ($tabAllUser as $user)
            {
                $pass= $user['password'];
                $password=password_hash($pass,PASSWORD_DEFAULT);

                if(!isset($password))
                {
                    return null;
                }
                else
                {
                   $this->updateMDPUser($user['login'],$password);
                }
            }
        }
    }

    public function ajoutUtil($login,$password,$mail)
    {
         $newPass=password_hash($password,PASSWORD_DEFAULT);
         $query="INSERT INTO visiteur(login,password,mail,role) VALUES(:login,:password,:mail,'admin')";
         $this->con->executeQuery($query,array(':login'=>array($login,PDO::PARAM_STR),
             ':password'=>array($newPass,PDO::PARAM_STR),
             ':mail'=>array($mail,PDO::PARAM_STR)));
    }

    public function deleteAdmin($login)
    {
        $query="DELETE FROM visiteur WHERE login=:login";
        $this->con->executeQuery($query,array(':login'=>array($login,PDO::PARAM_STR)));
    }
}
?>