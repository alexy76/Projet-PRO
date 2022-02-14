<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Newsletters.php';
require_once '../tools/tools.php';

/** Initialisation des paramètres de la page */

if(session_status() === PHP_SESSION_NONE) session_start();

/** Valeur des metas */
$meta_title = "Boutique en ligne de vêtements de sport | ECOMMERCE.NET";
$meta_description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus magnam odit voluptate quo, numquam corrupti, eveniet veniam, repellendus reprehenderit recusandae at asperiores! Beatae, ipsa quidem adipisci impedit necessitatibus eius laudantium.";

/** Contrôleur d'ajout de mail dans la table Newsletters  */

if(isset($_POST['subscribeNews'], $_POST['NewsLetterMail']) && filter_var($_POST['NewsLetterMail'], FILTER_VALIDATE_EMAIL)){

    $mail = strtolower(cleanData($_POST['NewsLetterMail']));

    $Newsletters = new Newsletters;

    if($Newsletters->setMail($mail))
        $messageFlash = '';

}




?>