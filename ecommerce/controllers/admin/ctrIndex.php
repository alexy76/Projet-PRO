<?php
/** Initialisation des paramètres de la page */
if (session_status() === PHP_SESSION_NONE) session_start();
if(!isset($_SESSION['id']) || $_SESSION['role'] != 2)
{
    header('Location: ../login.php');
    exit();
}

require_once "../../tools/PHPMailer/PHPMailerAutoload.php";
require_once '../../config.php';
require_once '../../models/Database.php';
require_once '../../models/Users.php';
require_once '../../tools/tools.php';

$Users = new Users;

/** Contrôleur de suppression d'un utilisateur */
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser']))
{
    if($Users->deleteUser((int)$_POST['idUser']))
    {
        $flashToast = true;
        $flashMsg = ['success', 'Le compte de '. $_POST['nameUser'].' a été supprimé'];
    }
}


/** Pagination des utilisateurs en fonction de la méthode de tri sélectionnée */
$nameMethod = 'AllClients';

if(isset($_POST['req']) && !empty($_POST['req']))   $req = $_POST['req'];
if(isset($_GET['req']) && $_GET['req'] != '')       $req = $_GET['req'];

if(isset($_GET['search']) && method_exists($Users, 'getCount_'.$_GET['search']))
    $nameMethod = $_GET['search'];


$nbClients = $Users->{'getCount_'.$nameMethod}(isset($req) ? $req.'%' : '');
$nbElt = 8;
$nbPages = ceil($nbClients / $nbElt);
$offset = isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] <= $nbPages ? ($_GET['page'] * $nbElt) - $nbElt : 0;
$pageActual = ($offset / $nbElt) + 1;


$getAllClients = $Users->{'get_'.$nameMethod}(isset($req) ? $req.'%' : '', $nbElt, $offset);
?>