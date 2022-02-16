<?php
/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if(!isset($_SESSION['id']))
{
    header('Location: login.php?noAllowed');
    exit();
}


require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../tools/tools.php';

