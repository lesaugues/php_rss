<?php

class Visiteur
{
    private $login;
    private $password;
    private $mail;
    private $role;

    public function __construct($login,$password,$mail,$role)
    {
        $this->login=$login;
        $this->password=$password;
        $this->mail=$mail;
        $this->role=$role;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getRole()
    {
        return $this->role;
    }
}
?>