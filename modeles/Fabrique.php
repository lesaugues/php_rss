<?php

class Fabrique
{
    public static function creationNews($tab)
    {
        if(isset($tab))
        {
            if(!empty($tab))
            {
                foreach ($tab as $news)
                {
                    $tabNews[]=new News($news['titre'],$news['categorie'],$news['date'],$news['description'],$news['link']);
                }
                return $tabNews;
            }
        }
        else
        {
            return null;
        }
    }

    public static function creationVisiteur($tab)
    {
        if(isset($tab))
        {
            if(!empty($tab))
            {
                foreach ($tab as $visiteur)
                {
                    $tabVisiteur=new Visiteur($visiteur['login'],$visiteur['password'],$visiteur['mail'],$visiteur['role']);
                }
                return $tabVisiteur;
            }
        }
        else
        {
            return null;
        }
    }
}
?>