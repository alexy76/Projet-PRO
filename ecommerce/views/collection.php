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
    <div class="card text-center" style="min-height: 70vh;">

        <div class="card-body">

            <div class="row mb-5">
                <h1 class="col-lg-6 col-12 text-lg-start text-center ps-lg-5 ps-0 h2"><?= $collectionName['col_name'] ?> <?= ucfirst(strtolower($collectionName['cat_name'])) ?> SportXtrem</h1>
                <div class="d-flex col-lg-6 col-12 text-end pe-lg-5 pe-1 justify-content-end">
                    <select id="sortsProducts" class="form-select form-select-sm w-lg-25 w-50 h-75 mt-lg-0 mt-3" aria-label=".form-select-sm example">
                        <option <?= strtolower($_GET['query']) == 'all' ? 'selected' : '' ?> disabled>Trier par</option>
                        <option value="priceasc" <?= strtolower($_GET['query']) == 'priceasc' ? 'selected' : '' ?>>Prix: faible à élevé</option>
                        <option value="pricedesc" <?= strtolower($_GET['query']) == 'pricedesc' ? 'selected' : '' ?>>Prix: élevé à faible</option>
                    </select>
                </div>
            </div>

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
                            <?php if ($product->discountPrice > 0) : ?>
                                <span class="d-inline-block text-dark px-3 py-1" style="position: absolute; top: 0px; right: 12px; font-size: 0.9rem; font-weight: bold; background-color: #ffea28;">Promo -<?= $product->discountPrice ?>%</span>
                            <?php endif; ?>
                            <img src="../../assets/img/products/<?= $product->imageProduct ?>" class="card-img-top img-fluid" style="" alt="<?= $product->labelImage ?>">
                            <div class="card-body">
                                <h2 class="card-title h6 mb-4"><?= ucfirst(strtolower($product->titleProduct)) ?></h2>
                                <p class="card-text fixed-bottom position-absolute mb-2"><?= $product->discountPrice > 0 ? '<span class="text-secondary"><del>' . number_format($product->priceProduct, 2, ',', ' ') . '€</del> ' . number_format($product->priceProduct - ($product->priceProduct * ($product->discountPrice / 100)), 2, ',', ' ') . ' €</span>' : '<span class="text-secondary">' . number_format($product->priceProduct, 2, ',', ' ') . ' €</span>' ?></p>
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

                    <?php endforeach; ?>

            </div>

            <nav class="text-center d-inline-block m-auto" aria-label="...">
                <ul class="pagination">
                    <li class="page-item <?= $pageActual == 1 ? 'disabled' : '' ?>">
                        <a class="page-link <?= $pageActual == 1 ? '' : 'btnBlueDark' ?>" href="/collection/<?= strtolower($_GET['query']) ?>/<?= $pageActual - 1 ?>/<?= $_GET['id'] ?>/<?= $collection['slug'] ?>">Précédent</a>
                    </li>
                    <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link <?= $i == $pageActual ? 'btnBlueDark' : 'text-dark' ?>" href="/collection/<?= strtolower($_GET['query']) ?>/<?= $i ?>/<?= $_GET['id'] ?>/<?= $collection['slug'] ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $pageActual == $nbPages || ($pageActual == 1 && $nbPages == 0) ? 'disabled' : '' ?>">
                        <a class="page-link <?= $pageActual == $nbPages || ($pageActual == 1  && $nbPages == 0) ? '' : 'btnBlueDark' ?>" href="/collection/<?= strtolower($_GET['query']) ?>/<?= $pageActual + 1 ?>/<?= $_GET['id'] ?>/<?= $collection['slug'] ?>">Suivant</a>
                    </li>
                </ul>
            </nav>
            
        <?php endif; ?>

        </div>
    </div>

</div>

<script>
    document.getElementById('sortsProducts').addEventListener('change', (e) => {
        console.log(window.location.href);
        let url = window.location.href.split('/');
        url[4] = document.getElementById('sortsProducts').value
        window.location.assign(url.join('/'))
    })
</script>

<?php
include '../views/templates/footer.php';
?>