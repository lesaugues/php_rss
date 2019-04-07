<?php

class FrontControleur
{
    private $listeAction_Admin=array('afficherNews','supprimer','ajouter','deconnexion');
    private $listeAction_SuperAdmin=array('afficherNews','addAdmin','suppAdmin','updateMDP','deconnexion1');

    public function __construct()
    {
        global $rep,$vues;

        try
        {
            if(isset($_REQUEST['action']))
            {
                $action=Validation::validString($_REQUEST['action']);
            }
            else
            {
                $action = null;
            }

            if(in_array($action,$this->listeAction_Admin))
            {
                if(ModeleAdmin::isAdmin()!=null)
                {
                    new ControleurAdmin();
                }
                else
                {
                    require_once($rep.$vues['vueConnection']);
                }
            }

            if(in_array($action,$this->listeAction_SuperAdmin))
            {
                if(ModeleSuperAdmin::isSuperAdmin()!=null)
                {
                    new ControleurSuperAdmin();
                }
                else
                {
                    require_once($rep.$vues['vueConnection']);
                }
            }
            else
            {
                new ControleurVisiteur();
            }
        }

        catch (Exception $e)
        {
            $dVueEreur[] =	"Erreur !!! Exception inconnue dans FrontControleur\n".$e->getMessage();
            require ($rep.$vues['erreur']);
        }
        catch (Error $e2)
        {
            $dVueEreur[] =	"Erreur !!! Erreur inconnue dans le FrontControleur\n".$e2->getMessage();
            require ($rep.$vues['erreur']);
        }

        exit(0);
    }
}
?>