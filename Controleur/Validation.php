<?php

class Validation
{
    public static function isEmail($addr)
    {
        return filter_var($addr, FILTER_VALIDATE_EMAIL);
    }

    public static function validString($var)
    {
        return filter_var($var,FILTER_SANITIZE_STRING);
    }

    public static function validInt($int)
    {
        return filter_var($int,FILTER_SANITIZE_NUMBER_INT);
    }


    public static function validUrl($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    public static function validPage($page):int
    {
        if($page==NULL or $page<=0)
        {
            return 1;
        }
        if(filter_var(FILTER_VALIDATE_INT))
        {
            return $page;
        }
        else
        {
            return 1;
        }
    }

    public static function nettoyage($val):string
    {
        $val = strip_tags($val);
        $val = trim($val);
        $val = stripslashes($val);
        return $val;
    }

}
?>
