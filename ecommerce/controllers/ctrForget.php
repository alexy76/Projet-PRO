<?php
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../tools/tools.php';


/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();

/** Valeur des metas */
$meta_title = 'Récupération de votre mot de passe | ECOMMERCE.NET';
$meta_description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus magnam odit voluptate quo, numquam corrupti, eveniet veniam, repellendus reprehenderit recusandae at asperiores! Beatae, ipsa quidem adipisci impedit necessitatibus eius laudantium.";


//session set var datetime redirect to timer !


// Controleur permettant la réinitialisation du mot de passe 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['renewPwd'])) {

    $errors = [];
    $Users = new Users();
    $mail = cleanData($_POST['mail']);

    if (empty($mail))
        $errors['mail'] = 'Veuillez saisir une adresse mail';
    elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL))
        $errors['mail'] = 'Le format de l\'email est incorrect';
    elseif (!$Users->getExistUsermail($mail)){
        $messageAlert = ['danger', 'Cette adresse mail n\'existe pas'];
        $errors['mail'] = '';
    }


    if (empty($_POST['g-recaptcha-response']))
        $errors['reCaptcha'] = 'Veuillez valider le reCAPTCHA';
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode('6LdB5HAeAAAAAChezk16TaVcl5O2ACuH_2KrZPfV') .  '&response=' . urlencode($_POST['g-recaptcha-response']);
        $responseKeys = json_decode(file_get_contents($url), true);

        if (!$responseKeys["success"])
            $errors['reCaptcha'] = 'Bots interdit sur ce site';
    }


    if (empty($errors)) {
        echo 'c"est cool';
    }
}

// $Users = new Users;
// if($Users->setTokenPassword('alexy.lepretre76@laposte.net'))
//     echo "ok";
// else
//     echo "pas ok";
