<?php

class News
{
    private $titre;
    private $categorie;
    private $date;
    private $description;
    private $link;

    public function __construct($titre=null,$categorie=null,$date_publi=null,$description=null,$link=null)
    {
        $this->titre=$titre;
        $this->categorie=$categorie;
        $this->date_publi=$date_publi;
        $this->description=$description;
        $this->link=$link;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function setDatePubli($date)
    {
        $this->date = $date;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLink()
    {
        return $this->link;
    }
}
?>