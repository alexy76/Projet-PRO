<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../tools/tools.php';


$Users = new Users;


if (isset($_POST['name'])) 
{
    $users = cleanData($_POST['name']);

    foreach ($Users->getName($users) as $user) {

        echo "<option>" . $user->usr_lastname . "</option>";
    }
}


if(isset($_POST['position'])){
    echo print_r($_POST['position']);
}