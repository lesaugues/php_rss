<?php

class ControleurSuperAdmin
{
    private $MSAdmin;
    private $MVisiteur;

    public function __construct()
    {
        global $rep,$vues;
        $dVueEreur = array ();

        try {
            if(Validation::validString($_REQUEST['action']))
            {
                $action=$_REQUEST['action'];
            }
            else{
                $action=null;
            }

            $this->MSAdmin= new ModeleSuperAdmin();

            switch ($action)
            {
                case NULL:
                    $this->afficherNews();
                    break;

                case "deconnexion1":
                    $this->deconnexionSA();
                    break;

                case "updateMDP":
                    $this->updateMDP();
                    break;

                case "addAdmin":
                    $this->addAdmin();
                    break;

                case "suppAdmin":
                    $this->suppAdmin();
                    break;

                default:
                    $dVueEreur[] =	"Erreur !!! Action inexistante";
                    require ($rep.$vues['erreur']);
                    break;
            }
        }
        catch (PDOException $e)
        {
            $dVueEreur[]="Document: <b>".$e->getFile()."</b><br />";
            $dVueEreur[]="Line: <b>".$e->getLine()."</b><br />";
            $dVueEreur[]="Code d'erreur: <b>".$e->getCode()."</b><br />";
            $dVueEreur[]="Message d'erreur: <b>".$e->getMessage()."</b><br />";
            $dVueEreur[] =	"Erreur !!! PDOException dans le ControleurSuperAdmin";
            require ($rep.$vues['erreur']);
        }
        catch (Exception $e2)
        {
            $dVueEreur[] =	"Erreur !!! Exception inconnue dans ControleurSuperAdmin\n".$e2->getMessage();
            require ($rep.$vues['erreur']);
        }
        catch (Error $e3)
        {
            $dVueEreur[] =	"Erreur !!! Erreur inconnue dans ControleurSuperAdmin\n".$e3->getMessage();
            require ($rep.$vues['erreur']);
        }
        exit(0);
    }

    function afficherNews()
    {
        global $rep,$vues;

        if(isset($_COOKIE['nbNews']))
        {
            $nb = Validation::validInt($_COOKIE['nbNews']);
            if ($nb == false)
            {
                $dVueEreur[] = "Erreur cookie invalide ";
            }
        }
        else
        {
            $nb=5;
        }

        if(isset($_GET['page']))
        {
            $page =$_GET['page'];
        }
        else
        {
            $page = 1;
        }

        $m=new ModeleVisiteur();
        $tabNews=$m->getNews($page,$nb);
        Validation::validInt($tabNews);
        require($rep.$vues['pageprincipale']);
    }

    private function deconnexionSA()
    {
        global $rep,$vues;
        if(isset($_SESSION['login']) && isset($_SESSION['role']))
        {
            ModeleSuperAdmin::deconnexion1();
            $_REQUEST=array();
            $_REQUEST['action']=null;
            new ControleurVisiteur();
        }
        else
        {
            $dVueEreur[] =	"Disfonctionnement !!! Tentative de déconnexion d'un utilisateur non connecté";
            require ($rep.$vues['erreur']);
        }
    }

    private function updateMDP()
    {
        global $rep,$vues;
        if(isset($_REQUEST['login']) && isset($_REQUEST['oldPassword']) && isset($_REQUEST['newPassword']))
        {
           $this->MSAdmin->updatePassword($_REQUEST['login'],$_REQUEST['oldPassword'],$_REQUEST['newPassword']);
           $_REQUEST=array();
           $_REQUEST['action']=null;
           new ControleurSuperAdmin();
        }
        else
        {
            echo($_REQUEST['login'].$_REQUEST['oldPassword'].$_REQUEST['newPassword']);
            $dVueEreur[] =	"Erreur !!! Certains champs du formulaire n'ont pas été remplis";
            require ($rep.$vues['erreur']);
        }
    }

    private function addAdmin()
    {
        global $rep,$vues;
        if(isset($_REQUEST['login']) && isset($_REQUEST['password']) && isset($_REQUEST['mail']))
        {
            $this->MSAdmin->ajouterAdmin($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['mail']);
            $_REQUEST=array();
            $_REQUEST['action']=null;
            new ControleurSuperAdmin();
        }
        else
        {
            $dVueEreur[] =	"Erreur !!! Certains champs du formulaire n'ont pas été remplis";
            require ($rep.$vues['erreur']);
        }
    }
    private function suppAdmin()
    {
        global $rep,$vues;
        if(isset($_REQUEST['login']) && isset($_REQUEST['password']))
        {
            $res=$this->MSAdmin->deleteAdmin($_REQUEST['login'],$_REQUEST['password']);
            if($res!=true)
            {
                $dVueEreur[] =	"Suppression Admin échoué";
                require ($rep.$vues['erreur']);
            }
            else{
                $_REQUEST=array();
                $_REQUEST['action']=null;
                new ControleurSuperAdmin();
            }
        }
        else{
            $dVueEreur[] =	"Suppression Admin échoué";
            require ($rep.$vues['erreur']);
        }
    }
}
?>