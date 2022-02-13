<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Newsletters.php';
require_once '../tools/cleanData.php';

var_dump($_POST);

if(isset($_POST['subscribeNews'], $_POST['NewsLetterMail']) && filter_var($_POST['NewsLetterMail'], FILTER_VALIDATE_EMAIL)){

    $mail = strtolower(cleanData($_POST['NewsLetterMail']));

    $Newsletters = new Newsletters;

    if($Newsletters->setMail($mail))
        $messageFlash = '';

}




?>