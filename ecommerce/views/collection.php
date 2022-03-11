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

                        <div class="card card<?= $key ?> cardRelative col-lg-3 col-12 mb-5" style="border: 0px;">
                            <img src="../../assets/img/products/<?= $product->imageProduct ?>" class="card-img-top img-fluid" alt="<?= $product->labelImage ?>">
                            <div class="card-body">
                                <h2 class="card-title h6"><?= ucfirst(strtolower($product->titleProduct)) ?></h2>
                                <p class="card-text">kjhykujghkugf</p>
                            </div>
                            <div class="card__overlay">
                                <div class="overlay__text">
                                    <div class="buttons">
                                        <div class="containerglass">
                                            <a href="../../product/<?= $product->idProduct ?>/<?= $product->slugProduct ?>" class="btnglass effect01" target="_blank"><span>VOIR</span></a>
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