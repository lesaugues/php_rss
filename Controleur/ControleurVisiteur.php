<?php
include('../DAL/News.php');
include ('../XmlParser.php');

class ControleurVisiteur
{
    private $MVisiteur;
    function __construct()
    {
        global $rep,$vues;
        $this->MVisiteur=new ModeleVisiteur();
        $dVueEreur = array ();

        try{
            if(isset($_REQUEST['action']))
            {
                if(Validation::validString($_REQUEST['action']))
                {
                    $action=$_REQUEST['action'];
                }
                else{
                    $action=null;
                }
            }
            else
            {
                $action= NULL;
            }


            ///// Test pour le parser
            /// Doit être dans le appel.php pas dans le controleur visiteur

            /*
            $parser= new XmlParser();
            $parser->setPath("./rss.xml"); //"https://www.engadget.com/rss.xml"
            $parser->parse();
            $result = $parser ->getResult();

            if(isset($result))
            {
                foreach ($result as $item)
                {
                    $insert=$this->MVisiteur->AjouterXML($item->getTitre(),$item->getCategorie(), $item->getDate(), $item->getDescription(), $item->getLink());
                    if($insert == null)
                    {
                        echo("erreur insertttion");
                    }
                }

            }
            else{
                echo("tab pas set");
            }
            */


            switch($action)
            {
                case NULL:
                    $this->afficherNews();
                    break;

                case "connection":
                    $this->Connection();
                    break;

                case "connectionSuperAdmin":
                    $this->ConnectionSuperAdmin();
                    break;

                case "setCookie":
                    $this->setCookie();
                    break;

                default:
                    $dVueEreur[] =	"Erreur !!! Action inexistante";
                    require ($rep.$vues['pageprincipale']);
                    break;
            }

        }
        catch (PDOException $e)
        {
            $dVueEreur[] =	"Erreur !!! PDOException dans le ControleurVisiteur";
            require ($rep.$vues['erreur']);

        }
        catch (Exception $e2)
        {
            $dVueEreur[] =	"Erreur !!! Exception inconnue dans ControleurVisiteur\n".$e2->getMessage();
            require ($rep.$vues['erreur']);
        }

        catch (Error $e3)
        {
            $dVueEreur[] =	"Erreur !!! Erreur inconnue dans ControleurVisiteur\n".$e3->getMessage();
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
                $dVueEreur[] = "Erreur !!! Cookie invalide ";
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

    function findSpecificPage()
    {
        global $rep,$vues;

        if(isset($_GET['page']))
        {
            $page =$_GET['page'];
        }
        else
        {
            $page = 1;
        }
        $m=new ModeleVisiteur();
        $tabNews=$m->getNews($page);
        require($rep.$vues['pageprincipale']);
    }

    public function Connection()
    {
        global $rep,$vues;

        if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
            $admin = new ModeleAdmin();
            $result = $admin->connexion($_REQUEST['login'], $_REQUEST['password']);

            if ($result == false) {
                $dVueEreur[] =	"Erreur !!! Result NULL dans la méthode Connexion() dans le ControleurVisiteur";
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
            $dVueEreur[] =	"Erreur !!! Certains champs du formulaire n'ont pas été remplis";
            require ($rep.$vues['erreur']);
        }
    }

    public function ConnectionSuperAdmin()
    {
        global $rep,$vues;

        if(isset($_REQUEST['login']) && isset($_REQUEST['password']))
        {
            $admin = new ModeleSuperAdmin();
            $result = $admin->connexion($_REQUEST['login'], $_REQUEST['password']);

            if ($result == false)
            {
                $dVueEreur[] =	"Erreur !!! Result NULL dans la méthode ConnexionSuperAdmin() dans le ControleurVisiteur";
                require ($rep.$vues['erreur']);
            }
            else
            {
                $_REQUEST = array();
                $_REQUEST['action'] = null;
                new ControleurSuperAdmin();
            }

        }
        else
        {
            $dVueEreur[] =	"Erreur !!! Certains champs du formulaire n'ont pas été remplis";
            require ($rep.$vues['erreur']);
        }
    }

    public function setCookie()
    {
        global $rep,$vues;

        if(isset($_REQUEST['nbNews']))
        {
            setCookie("nbNews",Validation::validInt($_REQUEST['nbNews']),time()+24*3600);

            $_REQUEST=array();
            $_REQUEST['action']=null;
            new ControleurVisiteur();
        }
        else
        {
            $dVueEreur[] =	"Erreur inattendue!!! ";
            require ($rep.$vues['erreur']);
        }
    }
}
?>