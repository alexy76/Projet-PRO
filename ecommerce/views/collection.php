<?php
require_once '../controllers/ctrCollection.php';
include '../views/templates/header.php';
?>

<a href="/" class="linklogin">
    <h1 class="text-center mt-5 text-white">Collections</h1>
</a>

<div class="container mt-5">

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
                            <img src="../assets/img/products/<?= $product->imageProduct ?>" class="card-img-top img-fluid" alt="<?= $product->labelImage ?>">
                            <div class="card-body">
                                <h2 class="card-title h6"><?= ucfirst(strtolower($product->titleProduct)) ?></h2>
                                <p class="card-text"></p>
                            </div>
                            <div class="card__overlay">
                                <div class="overlay__text">
                                    <a href="./product.php?id=<?= $product->idProduct ?>&slug=<?= $product->slugProduct ?>" class="btn btn-primary px-5 py-2 fs-5 border border-2 border-white">Voir</a>
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