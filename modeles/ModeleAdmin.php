<?php

class ModeleAdmin
{
    private $con;
    private $Visiteur;
    private $News;

    public function __construct()
    {
        global $dsn, $login, $mdp;
        $this->con=new Connection($dsn,$login, $mdp);
        $this->Visiteur=new VisiteurGateway($this->con);
        $this->News=new NewsGateway($this->con);
    }

    public function connexion($login,$password)
    {
        $login=Validation::validString($login);
        $password=Validation::validString($password);
        $b=$this->Visiteur->checkUser($login,$password);

        if($b==false)
        {
            return null;
        }
        else
        {
            $_SESSION['role'] = 'admin';
            $_SESSION['login'] = 'login';
            return new Visiteur($login, $password, null, 'admin');
        }
    }

    public static function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION=array();
    }

    public static function isAdmin()
    {
        if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role']=='admin')
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

    public function Ajouter($titre,$categ,$date,$desc,$lien)
    {
        $titre=Validation::validString($titre);
        $categ=Validation::validString($categ);
        $date=Validation::validString($date);
        $desc=Validation::validString($desc);
        $lien=Validation::validUrl($lien);

        if(!$titre or !$categ or !$date or !$desc or !$lien)
            return null;

        $this->News->ajouterNews($titre,$categ,$date,$desc,$lien);
        return true;
    }

    public function ajouterXml(News $n)
    {
        $this->News->ajouterNews($n->getTitre(),$n->getCategorie(),$n->getDate(),$n->getDescription(),$n->getLink());
    }

    public function Supprimer($titre)
    {
        $titre=Validation::validString($titre);
        if(!$titre)
            return null;

        $this->News->supprimerNews($titre);
        return true;
    }

}
?>