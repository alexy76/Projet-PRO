<?php
require_once "../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Collections.php';
require_once '../models/Newsletters.php';
require_once '../tools/tools.php';


/** Initialisation des paramètres de la page */
if(session_status() === PHP_SESSION_NONE) session_start();


$Collections = new Collections;


/** Contrôleur d'ajout de mail dans la table Newsletters  */
if(isset($_POST['subscribeNews'], $_POST['NewsLetterMail']) && filter_var($_POST['NewsLetterMail'], FILTER_VALIDATE_EMAIL)){

    $Newsletters = new Newsletters;
    if($Newsletters->setMail(strtolower(cleanData($_POST['NewsLetterMail'])))){
        $flashToast = true;
        $flashMsg = ['success', 'Inscription validée'];
    }
}