<?php
/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if(!isset($_SESSION['id']) || $_SESSION['role'] != 2)
{
    header('Location: ../login.php');
    exit();
}
?>