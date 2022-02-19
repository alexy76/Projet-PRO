<?php

/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 2) {
    header('Location: ../login.php');
    exit();
}

require_once "../../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../../config.php';
require_once '../../models/Database.php';
require_once '../../models/Category.php';
require_once '../../models/Collections.php';
require_once '../../tools/tools.php';

$Category = new Category;
$Collections = new Collections;



foreach($Collections->getCollections() as $key => $value){

    $final[$key]['collections'] = array_combine(explode(',', $value->idCol), explode(',', $value->nameCol));
    $final[$key]['category'] = [$value->idCat => $value->nameCat];
}

var_dump($final);


/** Contrôleur permettant l'ajout d'une nouvelle catégorie */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCategory']) && isset($_POST['nameCategory'])) {
    $nameCategory = cleanData($_POST['nameCategory']);

    if ($Category->setCategory($nameCategory)) {
        $flashToast = true;
        $flashMsg = ['success', 'La catégorie "' . $nameCategory . '" a été ajoutée'];
    }
}

/** Contrôleur permettant l'ajout d'une collection dans une catégorie */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCollection'])) {
    // var_dump($Category->existIdCategory(18));

    if (!empty($_POST['nameCollection'])) {
        if (isset($_POST['catCollection']) && !ctype_digit($_POST['catCollection'])) {
            var_dump('Veuillez selectionner une catégorie qui existe');
        } elseif (isset($_POST['catCollection']) && !$Category->existIdCategory($_POST['catCollection'])) {
            var_dump('N\'existe pas en base de données !');
        } elseif (!isset($_POST['catCollection'])) {
            var_dump('Veuillez selectionner une catégorie');
        } else {
            echo "ok";
            $nameCollection = cleanData($_POST['nameCollection']);
            if($Collections->setNameCollection($nameCollection, $_POST['catCollection'])){
                var_dump("Ajout de la collection ok ");
            }
        }
    }else{
        var_dump("Veuillez entrer un nom pour la collection");
    }
}
var_dump($_POST);

$listCategory = $Category->getCategory();
