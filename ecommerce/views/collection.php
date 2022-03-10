<?php
require_once '../controllers/ctrCollection.php';
include '../views/templates/header.php';
?>

<a href="/" class="linklogin">
    <h1 class="text-center mt-5 text-white">Collections</h1>
</a>

<div class="container mt-5">

    <div class="card text-center">
        <!-- <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="">Collections</a>
                    </li>
                </ul>
            </div> -->
        <div class="card-body">



                    <h1 class="card-title mb-5"></h1>

                    <div class="row justify-content-center p-lg-3 p-1">

                    <?php foreach($productsByCollection as $product) : ?>

                        <div class="card col-lg-3 col-12 mb-5" style="border: 0px;">
                            <img src="../assets/img/products/<?= $product->imageProduct ?>" class="card-img-top" alt="<?= $product->labelImage ?>">
                            <div class="card-body">
                                <h2 class="card-title h6"><?= ucfirst(strtolower($product->titleProduct)) ?></h2>
                                <p class="card-text"></p>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    </div>


        </div>
    </div>

</div>

<?php
include '../views/templates/footer.php';
?>