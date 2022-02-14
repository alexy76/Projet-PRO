<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Newsletters.php';
require_once '../tools/tools.php';

/** Initialisation des paramètres de la page */

if(session_status() === PHP_SESSION_NONE) session_start();



/** Contrôleur d'ajout de mail dans la table Newsletters  */

if(isset($_POST['subscribeNews'], $_POST['NewsLetterMail']) && filter_var($_POST['NewsLetterMail'], FILTER_VALIDATE_EMAIL)){

    $mail = strtolower(cleanData($_POST['NewsLetterMail']));

    $Newsletters = new Newsletters;

    if($Newsletters->setMail($mail))
        $messageFlash = '';

}




?>