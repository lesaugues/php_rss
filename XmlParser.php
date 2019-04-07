<?php

//include('./DAL/News.php');


/**
 * Classe parsant un fichier xml et affichant les informations sous la forme
 * d'une hierarchie de texte
 */
class XmlParser{
    private $path;
    private $result;
    private $depth;
    private $boolTitre, $boolCateg, $boolDate, $boolDesc, $boolLink;
    private $news;
    private $tabNews=array();
     
    public function __construct()
    {
        //$this -> path = $path;
        //$this -> depth = 0;
        $this -> path = dirname(__FILE__).'/rss.xml';
    }
     
    public function getResult() {
        var_dump($this->tabNews);
        return $this->tabNews;
    }

    public function setPath($path)
    {
       $this->path=$path;
    }

    /**
     * Parse le fichier et met le resultat dans Result
     */
    public function parse()
    {
        ob_start();
        $xml_parser = xml_parser_create();
        xml_set_object($xml_parser, $this);
        xml_set_element_handler($xml_parser, "startElement", "endElement");
        xml_set_character_data_handler($xml_parser, 'characterData');
        if (!($fp = fopen($this -> path, "r"))) {
            die("could not open XML input");
        }
 
        while ($data = fread($fp, 4096)) {
            if (!xml_parse($xml_parser, $data, feof($fp))) {
                die(sprintf("XML error: %s at line %d",
                            xml_error_string(xml_get_error_code($xml_parser)),
                            xml_get_current_line_number($xml_parser)));
            }
        }
         
        $this -> result = ob_get_contents();
        ob_end_clean();
        fclose($fp);
        xml_parser_free($xml_parser);
    }
     
    private function startElement($parser, $name, $attrs)
    {
        for ($i = 0; $i < $this -> depth; $i++) {
            echo "  ";
        }

        if($name=="ITEM" || $name=="item")
            $this->news = new News();


        if (isset($this->news))
        {
            if ($name == "TITLE" || $name == "title")
                $this->boolTitre = true;

            if ($name == "LINK" || $name == "link")
                $this->boolLink = true;

            if ($name == "DESCRIPTION" || $name == "description")
                $this->boolDesc = true;

            if ($name == "GATEGORY" || $name == "category")
                $this->boolCateg = true;

            if ($name == "PUBDATE" || $name == "pubDate" || $name == "pubdate")
                $this->boolDate = true;

        }
        $this->depth++;


        /*for ($i = 0; $i < $this -> depth; $i++) {
            echo "  ";
        }
        echo "<p style='color:red'> $name</p>\n";
        $this -> depth++;
        foreach($attrs as $attribute => $text)
        {
            $this ->displayAttribute($attribute, $text);
        }*/
    }
     
    private function displayAttribute($attribute, $text)
    {
        /*for ($i = 0; $i < $this -> depth; $i++) {
            echo "  ";
        }*/
         
        echo "A - $attribute = $text\n";
    }
 
    private function endElement($parser, $name)
    {
        if($name=="ITEM" || $name=="item")
            $this->tabNews[] = $this->news;


        if ($name == "TITLE" || $name == "title")
            $this->boolTitre = false;

        if ($name == "LINK" || $name == "link")
            $this->boolLink = false;

        if ($name == "DESCRIPTION" || $name == "description")
            $this->boolDesc = false;

        if ($name == "GATEGORY" || $name == "category")
            $this->boolCateg = false;

        if ($name == "PUBDATE" || $name == "pubDate" || $name == "pubdate")
            $this->boolDate = false;


        /*$this -> depth--;
        if($name == "ITEM")
        {
            $this->tabNews[]=$this->news;
        }*/


        //echo "<p style='color:red'> $name</p>\n";

    }
     
    private function characterData($parser, $data)
    {
        $data = trim($data);

        if($this->boolTitre == true)
        {
            $this->news->setTitre($data);
            $this->boolTitre=false;
        }

        if($this->boolLink == true)
        {
            $this->news->setLink($data);
            $this->boolLink=false;
        }


        if($this->boolDesc == true)
        {
            $this->news->setDescription($data);
            $this->boolDesc=false;
        }

        if($this->boolCateg == true)
        {
            $this->news->setCategorie($data);
            $this->boolCateg=false;
        }

        if($this->boolDate == true)
        {
            $this->news->setDatePubli($data);
            $this->boolDate=false;
        }



       /* if (strlen($data) > 0)
        {
            for ($i = 0; $i < $this -> depth; $i++) {
                echo "  ";
            }
 
            echo 'T :'.$data."\n";
        }*/
    }
}

/*  ///Autre type de parser
    $url = "https://tonyarchambeau.com/feed/"; insérer ici l'adresse du flux RSS de votre choix
    $rss = simplexml_load_file($url);
    echo '<ul>';
    foreach ($rss->channel->item as $item){
        $datetime = date_create($item->pubDate);
        $date = date_format($datetime, 'd M Y, H\hi');
        echo '<li><a href="'.$item->link.'">'.utf8_decode($item->title).'</a> ('.$date.')</li>';
    }
    echo '</ul>';
*/
?>

