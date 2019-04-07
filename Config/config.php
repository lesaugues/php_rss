<?php
// récupération du répertoire courant
$rep= __DIR__ .'/../';

// inclusion des modules
$dConfig['includes']= array('Controleur/Validation.php');
$dConfig['includes']= array('Controleur/ControleurVisiteur.php');
$dConfig['includes']= array('Controleur/ControleurAdmin.php');
$dConfig['includes']= array('Controleur/ControleurSuperAdmin.php');

// base de données
$dsn="mysql:host=localhost;dbname=dbprojet";
//$login="eloi";
//$mdp="eloi";
$login="leo";
$mdp="leo";

// récupération des vues
$vues['index']='index.php';
$vues['erreur']='Vues/erreur.php';
$vues['pageprincipale']='Vues/pageprincipale.php';
$vues['vueConnection']='Vues/vueConnection.php';
?>