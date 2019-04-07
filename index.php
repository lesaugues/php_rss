<?php
require_once(__DIR__.'/Config/config.php');
require_once(__DIR__.'/Config/Autoload.php');
require_once(__DIR__.'/XmlParser.php');
// autochargement des classes
Autoload::charger();
session_start();

$controleur = new FrontControleur();
?>
