<?php
require_once '../controllers/ctrProduct.php';
include '../views/templates/header.php';
?>

<div class="container mt-3 text-bluedark">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../views/home.php">SportXtrem</a></li>
            <li class="breadcrumb-item active"><?= ucfirst(strtolower($product['catName'])) ?></li>
            <li class="breadcrumb-item active"><a href="/collection/all/1/<?= $product['idCol'] ?>/<?= $product['slugCol'] ?>"><?= $product['colName'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= ucfirst(strtolower($product['title'])) ?></li>
        </ol>
    </nav>
    <div class="card text-center" style="min-height: 70vh;">

        <div class="card-body">

        </div>
    </div>

</div>

<?php
include '../views/templates/footer.php';
?>