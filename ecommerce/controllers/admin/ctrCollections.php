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
                $flashToast = true;
                $flashMsg = ['success', 'La catégorie "' . $nameCategory . '" a été ajoutée'];
            } else {
                $flashToast = true;
                $flashMsg = ['error', 'Une erreur s\'est produite'];
            }
        } else {
            $flashToast = true;
            $flashMsg = ['warning', 'Le nom de catégorie existe déjà'];
        }
    } else {
        $flashToast = true;
        $flashMsg = ['warning', 'Entrez un nom de catégorie'];
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
                            $flashToast = true;
                            $flashMsg = ['success', "La collection a été ajoutée"];
                        }
                    } else {
                        $flashToast = true;
                        $flashMsg = ['warning', "Le nom de collection existe déjà"];
                    }
                } else {
                    $flashToast = true;
                    $flashMsg = ['error', "La catégorie n'existe pas"];
                }
            }
        } else {
            $flashToast = true;
            $flashMsg = ['warning', 'Veuillez choisir une catégorie'];
        }
    } else {
        $flashToast = true;
        $flashMsg = ['warning', 'Veuillez saisir un nom de collection'];
    }
}



$listCategory = $Category->getCategory();
$listCollections = $Collections->getCollections();
