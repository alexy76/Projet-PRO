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

        <div class="card-body pt-4">
            <div class="row">


                <div class="col-lg-1">
                    <?php foreach ($product['images'] as $images) : ?>

                        <img class="img-fluid mb-3" src="../../assets/img/products/<?= $images['image'] ?>" alt="<?= $images['alt'] ?>">

                    <?php endforeach; ?>
                </div>
                <div class="col-lg-5">

                    <img class="img-fluid" src="../../assets/img/products/<?= $product['images'][0]['image'] ?>" alt="<?= $product['images'][0]['alt'] ?>">

                </div>
                <div class="col-lg-6">
                    <h1 class="h3"><?= $product['title'] ?></h1>
                </div>
            </div>
            <div class="col-12">
                kdheloihefl
            </div>
        </div>
    </div>

</div>

<?php
include '../views/templates/footer.php';
?>