<?php

class ControleurAdmin
{
    private $MVisiteur;
    private $MAdmin;

    function __construct()
    {
        global $rep,$vues;
        $dVueEreur = array ();

        try
        {
            if(Validation::validString($_REQUEST['action']))
            {
                $action=$_REQUEST['action'];
            }
            else{
                $action=null;
            }

            $this->MVisiteur= new ModeleVisiteur();
            $this->MAdmin=new ModeleAdmin();

            switch($action)
            {
                case NULL:
                    $this->afficherNews();
                    break;

                case "ajouter":
                    $this->ajouter();
                    break;

                case "supprimer":
                    $this->supprimer();
                    break;

                case "deconnexion":
                    $this->deconnexion();
                    break;

                default:
                    $dVueEreur[] =	"Erreur !!! Action inexistante";
                    require ($rep.$vues['erreur']);
                    break;
            }

        }
        catch (PDOException $e)
        {
            $dVueEreur[] =	"Erreur !!! PDOException dans ControleurAdmin";
            require ($rep.$vues['erreur']);
        }

        catch (Exception $e2)
        {
            $dVueEreur[] =	"Erreur !!! Exception inconnue dans ControleurAdmin";
            require ($rep.$vues['erreur']);
        }

        catch (Error $e3)
        {
            $dVueEreur[] =	"Erreur !!! Erreur inconnue dans ControleurAdmin\n".$e3->getMessage();
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
                $dVueEreur[] = "Erreur !!! Cookie invalide";
                require ($rep.$vues['erreur']);
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

    private function ajouter()
    {
        global $rep,$vues;

        if(isset($_REQUEST['titre']) && isset($_REQUEST['categ']) && isset($_REQUEST['date']) && isset($_REQUEST['desc']) && isset($_REQUEST['lien']))
        {
            $result=$this->MAdmin->Ajouter($_REQUEST['titre'],$_REQUEST['categ'],$_REQUEST['date'],$_REQUEST['desc'],$_REQUEST['lien']);
            if($result==null)
            {
                $dVueEreur[] =	"Erreur !!! Result de NULL dans la méthode ajouter() du ControleurAdmin";
                require ($rep.$vues['erreur']);
            }
            else
            {
                $_REQUEST = array();
                $_REQUEST['action'] = null;
                new ControleurAdmin();
            }
        }
        else
        {
            $dVueEreur[] = "Erreur !!! Certains champs du formulaire n'ont pas été remplis";
            require ($rep.$vues['erreur']);
        }
    }

    private function supprimer()
    {
        global $rep,$vues;
        if(isset($_REQUEST['titre']))
        {
            $result=$this->MAdmin->Supprimer($_REQUEST['titre']);
            echo($result[0][1]);
            if($result==null)
            {
                $dVueEreur[] =	"Erreur !!! Result NULL dans la méthode supprimer() du ContrôleurAdmin";
                require ($rep.$vues['erreur']);
            }
            else
            {
                $_REQUEST = array();
                $_REQUEST['action'] = null;
                new ControleurAdmin();
            }
        }
        else
        {
            $dVueEreur[] =	"Erreur !!! Le titre n'a pas été rentré";
            require ($rep.$vues['erreur']);
        }
    }

    private function deconnexion()
    {
        global $rep,$vues;
        if(isset($_SESSION['login']) && isset($_SESSION['role']))
        {
            ModeleAdmin::deconnexion();
            $_REQUEST=array();
            $_REQUEST['action']=null;
            new ControleurVisiteur();
        }
        else{
            $dVueEreur[] =	"Disfonctionnement !!! Tentative de déconnexion d'un utilisateur non connecté";
            require ($rep.$vues['erreur']);
        }
    }
}
?>