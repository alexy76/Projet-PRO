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



/** Contrôleur permettant l'ajout d'une nouvelle catégorie */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCategory'], $_POST['nameCategory'])) {

    if (!empty($_POST['nameCategory'])) {

        $nameCategory = cleanData($_POST['nameCategory']);

        if (!$Category->getExistCategory($nameCategory)) {

            if ($Category->setCategory($nameCategory, formatSlug($nameCategory))) {
var_dump('lfdkljf');
                $flashMsg = [true, 'success', 'La catégorie ' . $nameCategory . ' a été ajoutée'];
                var_dump($flashMsg);
            } else {
                $flashMsg = [true, 'error', 'Une erreur s\'est produite'];
            }
        } else {
            $flashMsg = [true, 'warning', 'Le nom de catégorie existe déjà'];
        }
    } else {
        $flashMsg = [true, 'warning', 'Entrez un nom de catégorie'];
    }
}



/** Contrôleur permettant l'ajout d'une collection dans une catégorie */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCollection'])) {


    if (!empty($_POST['nameCollection'])) {

        if (isset($_POST['catCollection'])) {

            if (ctype_digit($_POST['catCollection'])) {

                if ($Category->existIdCategory(intval($_POST['catCollection']))) {

                    $nameCollection = cleanData($_POST['nameCollection']);

                    if (!$Collections->getExistCollection($nameCollection)) {

                        if ($Collections->setNameCollection($nameCollection, formatSlug($nameCollection), intval($_POST['catCollection']))) {

                            $flashMsg = [true, 'success', "La collection a été ajoutée"];
                        }
                    } else {
                        $flashMsg = [true, 'warning', "Le nom de collection existe déjà"];
                    }
                } else {
                    $flashMsg = [true, 'error', "La catégorie n'existe pas"];
                }
            }
        } else {
            $flashMsg = [true, 'warning', 'Veuillez choisir une catégorie'];
        }
    } else {
        $flashMsg = [true, 'warning', 'Veuillez saisir un nom de collection'];
    }
}



$listCategory = $Category->getCategory();
$listCollections = $Collections->getCollections();
