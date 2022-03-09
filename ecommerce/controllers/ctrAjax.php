<?php

require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Users.php';
require_once '../models/Category.php';
require_once '../models/Collections.php';
require_once '../models/Products.php';
require_once '../tools/tools.php';


$Users = new Users;
$Collections = new Collections;
$Category = new Category;
$Products = new Products;


if (isset($_POST['name'])) 
{
    $users = cleanData($_POST['name']);

    foreach ($Users->getName($users) as $user) {

        echo "<option>" . $user->usr_lastname . "</option>";
    }
}


if (isset($_POST['nameProduct'])) 
{
    $products = cleanData($_POST['nameProduct']);

    foreach ($Products->getNamesProducts($products) as $product) {

        echo "<option>" . $product->pdt_title . "</option>";
    }
}


if(isset($_POST['position'])){


    $errors = [];

    

    foreach($_POST['position'] as $key => $idCollection)
    {
        if(!$Collections->setNewPositionCollection($idCollection, $key + 1))
            $errors[$key] = $idCollection;
    }

    if(empty($errors))
        echo "ok";
    else
        echo json_encode($errors);
}



if(isset($_POST['positionCategory'])){

    $errors = [];

    foreach($_POST['positionCategory'] as $key => $idCategory)
    {
        if(!$Category->setNewPositionCategory($idCategory, $key + 1))
            $errors[$key] = $idCategory;
    }

    if(empty($errors))
        echo "ok";
    else
        echo json_encode($errors);
}


if(isset($_POST['statusProduct'])){

    if($Products->changeStatusProduct(intval($_POST['idProduct']), intval($_POST['statusProduct']))){
        echo "ok";
    }
}