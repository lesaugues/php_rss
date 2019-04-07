<?php

class ModeleVisiteur
{
    private $news;
    private $visiteur;

    public function __construct()
    {
        global $dsn,$login,$mdp;
        $this->con=new Connection($dsn,$login,$mdp);
        $this->news=new NewsGateway($this->con);
        $this->visiteur=new VisiteurGateway($this->con);
    }

    public function getNews($page,$nbNews):array
    {
        global $dsn, $login, $mdp;
        $page=Validation::validPage($page);
        if($page==false)
            return null;

        $g=new NewsGateway(new Connection($dsn,$login, $mdp));

        return $g->findNewsByPage($page,$nbNews);
    }

    public function getNumberOfNews():int
    {
         global $dsn, $login, $mdp;
         $g=new NewsGateway(new Connection($dsn,$login, $mdp));
         return $g->nbNewsTotal();
    }

    public function ajouterXML($titre,$categ,$date,$description,$link)
    {
        $titre=Validation::validString($titre);
        $categ=Validation::validString($categ);
        $date=Validation::validString($date);
        $desc=Validation::validString($description);
        $lien=Validation::validUrl($link);

        //echo( "------------------->  TITRE :".$titre);
        //echo( "------------------->  CATEG :".$categ);
        //echo( "------------------->  DATE :".$date);
        //echo( "------------------->  DESC :".$desc);
        //echo( "------------------->  LIEN :".$lien);

        if(!$titre or !$categ or !$date or !$desc or !$lien)
            return null;

        $this->news->ajouterNews($titre,$categ,$date,$desc,$lien);
        return true;
    }

}
?>