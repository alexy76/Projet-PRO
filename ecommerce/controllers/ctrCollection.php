<?php
require_once "../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../models/Collections.php';
require_once '../models/Products.php';
require_once '../tools/tools.php';

/** Initialisation des paramètres de la page */
if(session_status() === PHP_SESSION_NONE) session_start();

$Collections = new Collections;


if(!isset($_GET['id']) || !ctype_digit($_GET['id']) || !$Collections->getExistIdCollection(intval($_GET['id']))){
    header('Location: 404');
    exit();
}

$Products = new Products;


$collectionName = $Collections->getCollectionByID(intval($_GET['id']));
$nbProducts = $Products->getCount_displayByCollection(intval($_GET['id']));

$nbElt = 8;
$nbPages = ceil($nbProducts / $nbElt);
$offset = isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] <= $nbPages ? ($_GET['page'] * $nbElt) - $nbElt : 0;
$pageActual = ($offset / $nbElt) + 1;


$productsByCollection = $Products->get_displayByCollection(intval($_GET['id']), strtolower($_GET['query']), $nbElt, $offset);


/** Valeur des metas (A VOIR PLUS TARD POUR LA RECHERCHER PAR COLLECTION) */
$meta_title = 'En cours de construction';
$meta_description = "En cours de construction";

?>