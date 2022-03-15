<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../models/Category.php';
require_once '../models/Collections.php';
require_once '../models/Products.php';
require_once '../tools/tools.php';


$Product = new Products;


if(isset($_POST['idProduct']) && ctype_digit($_POST['idProduct'])){
    //var_dump("test");
    echo $_POST['idProduct'];
}


?>