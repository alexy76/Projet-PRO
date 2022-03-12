<?php
require_once '../controllers/ctrCollection.php';
include '../views/templates/header.php';
?>

<div class="container mt-3 text-bluedark">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../views/home.php">SportXtrem</a></li>
            <li class="breadcrumb-item active"><?= ucfirst(strtolower($collectionName['cat_name'])) ?></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $collectionName['col_name'] ?></li>
        </ol>
    </nav>
    <div class="card text-center">

        <div class="card-body">

            <div class="row justify-content-center p-lg-3 p-1">

                <?php if (!$productsByCollection) : ?>
                    <p>Aucune données trouvées</p>
                    <?php
                else :
                    foreach ($productsByCollection as $key => $product) : ?>

                        <style>
                            .card<?= $key ?>:hover .card__overlay {
                                opacity: 1;
                            }
                        </style>
                        <div class="card card<?= $key ?> cardRelative col-lg-3 col-6 mb-5" style="border: 0px;">
                        <?php if($product->discountPrice > 0) : ?>
                        <span class="d-inline-block text-dark px-3 py-1" style="position: absolute; top: 0px; right: 12px; font-size: 0.9rem; font-weight: bold; background-color: #ffea28;">Promo -<?= $product->discountPrice ?>%</span>
                        <?php endif; ?>
                            <img src="../../assets/img/products/<?= $product->imageProduct ?>" class="card-img-top img-fluid" style="" alt="<?= $product->labelImage ?>">
                            <div class="card-body">
                                <h2 class="card-title h6 mb-4"><?= ucfirst(strtolower($product->titleProduct)) ?></h2>
                                <p class="card-text fixed-bottom position-absolute mb-2"><?= $product->discountPrice > 0 ? '<span class="text-secondary"><del>'.number_format($product->priceProduct, 2, ',', ' ').'€</del> '.number_format($product->priceProduct - ($product->priceProduct * ($product->discountPrice/100)), 2, ',', ' ').' €</span>' : '<span class="text-secondary">'.number_format($product->priceProduct, 2, ',', ' ').' €</span>' ?></p>
                            </div>
                            <div class="card__overlay">
                                <div class="overlay__text">
                                    <div class="buttons">
                                        <div class="containerglass">
                                            <a href="../../product/<?= $product->idProduct ?>/<?= $product->slugProduct ?>" class="btnglass <?= $product->discountPrice > 0 ? 'effect02' : 'effect01' ?>" target="_blank"><span><?= $product->discountPrice > 0 ? 'J\'EN PROFITE' : 'VOIR' ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php endforeach;
                endif; ?>

            </div>


        </div>
    </div>

            </div>

<?php
include '../views/templates/footer.php';
?>