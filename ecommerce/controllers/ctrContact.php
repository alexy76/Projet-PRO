<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Newsletters.php';
require_once '../tools/cleanData.php';

/** Initialisation des paramètres de la page */

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_POST['fromName'], $_POST['fromMail'], $_POST['messageMail'], $_POST['g-recaptcha-response'], $_POST['sendMail']))
{
    if(!emptyArray($_POST, 1)){
        echo 'tableau plein';
    }
    else
        $messageAlert = ['danger', 'Tous les champs doivent être complétés !'];
}

?>