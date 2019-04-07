<?php

class NewsGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function findNewsByPage($page,$nbNews):array
    {
        $nbNews=intval($nbNews,10);
        $news1=($page-1)*$nbNews;
        $query='SELECT * FROM news ORDER BY date LIMIT :news1,:nbNews';
        $this->con->executeQuery($query,array(':news1'=>array($news1,PDO::PARAM_INT),':nbNews'=>array($nbNews,PDO::PARAM_INT)));
        return Fabrique::creationNews($this->con->getResults());
    }


    public function ajouterNews($titre,$categorie,$date,$description,$link)
    {
        $query="INSERT INTO news VALUES(:titre,:categorie,:date,:description,:link)";
        $this->con->executeQuery($query,array(':titre'=>array($titre,PDO::PARAM_STR),
            ':categorie'=>array($categorie,PDO::PARAM_STR),
            ':date'=>array($date,PDO::PARAM_STR),
            ':description'=>array($description,PDO::PARAM_STR),
            ':link'=>array($link,PDO::PARAM_STR)));
    }

    public function supprimerNews($titre)
    {
        $query="DELETE FROM news WHERE titre=:titre";
        $this->con->executeQuery($query,array(':titre'=>array($titre,PDO::PARAM_STR)));
    }

    public function sortByCateg($categorie)
    {
        $query="SELECT * FROM news WHERE categorie=:categorie";
        $this->con->executeQuery($query,array(':categorie'=>array($categorie,PDO::PARAM_STR)));

        return Fabrique::creationNews($this->con->getResults());
    }
    public function nbNewsTotal()
    {
        $query="Select count(1) from news";
        $this->con->executeQuery($query,array());
        return $this->con->getResults();
    }
}
?>