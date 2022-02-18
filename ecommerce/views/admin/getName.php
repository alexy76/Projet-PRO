<?php

require_once '../../config.php';
require_once '../../models/Database.php';
require_once '../../models/Users.php';


$Users = new Users;

foreach($Users->getName($_POST['name']) as $user){
    echo "<option>" . $user->usr_lastname . "</option>";
}