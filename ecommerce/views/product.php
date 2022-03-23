<?php
require_once '../controllers/ctrProduct.php';
include '../views/templates/header.php';
?>

<div class="container mt-3 text-bluedark">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb colorlink">
            <li class="breadcrumb-item colorlink"><a href="../../views/home.php">Athlectic'Sports</a></li>
            <li class="breadcrumb-item active"><?= ucfirst(strtolower($product['catName'])) ?></li>
            <li class="breadcrumb-item active"><a href="/collection/all/1/<?= $product['idCol'] ?>/<?= $product['slugCol'] ?>"><?= $product['colName'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= ucfirst(strtolower($product['title'])) ?></li>
        </ol>
    </nav>
    <div class="card text-center" style="min-height: 70vh;">

        <div class="card-body pt-4">
            <div class="row">


                <div class="col-lg-1 d-lg-block d-none">
                    <?php foreach ($product['images'] as $key => $images) : ?>

                        <img class="img-fluid mb-3 imagesProduct <?= $key == 0 ? 'activeImg' : '' ?>" src="../../assets/img/products/<?= $images['image'] ?>" alt="<?= $images['alt'] ?>">

                    <?php endforeach; ?>
                </div>
                <div class="col-lg-5">
                    <a id="linkImageDisplay" data-lightbox='zoomImage' href='../../assets/img/products/<?= $product['images'][0]['image'] ?>'>
                        <img id="imageDisplay" class="img-fluid" src="../../assets/img/products/<?= $product['images'][0]['image'] ?>" alt="<?= $product['images'][0]['alt'] ?>">
                    </a>
                </div>

                <?php foreach ($product['images'] as $key => $images) : ?>
                    <div class="col-3 d-lg-none d-block mt-2">
                        <img class="img-fluid mb-3 imagesProduct <?= $key == 0 ? 'activeImg' : '' ?>" src="../../assets/img/products/<?= $images['image'] ?>" alt="<?= $images['alt'] ?>">
                    </div>
                <?php endforeach; ?>

                <div class="col-lg-6">
                    <h1 class="h3"><?= $product['title'] ?></h1>
                    <div class="px-lg-5 px-3 mt-4 bg-light shadow
                    py-3">


                        <p class="text-start">
                            <?=
                            $product['discount'] > 0 ?
                                '<span class="text-dark h3">' . number_format($product['price'] - ($product['price'] * ($product['discount'] / 100)), 2, ',', ' ') . '€ </span> <span class="text-secondary fs-4 ms-2"><del>' . number_format($product['price'], 2, ',', ' ') . '€</del></span>' :
                                '<span class="text-dark fs-3">' . number_format($product['price'], 2, ',', ' ') . '€</span>'
                            ?>
                        </p>


                        <?php if ($product['discount'] > 0) : ?>
                            <p class="text-start mt-4 mb-5"><span class="btnYellow fw-bold px-3 py-2 rounded"><?= $product['discount'] ?>% de réduction</span></p>
                        <?php endif; ?>


                        <?php if ($product['option'] != null) : ?>
                            <p class="text-start mt-4">Taille</p>
                            <select id="optionProduct" class="form-select" aria-label="Default select example">
                                <?php foreach (explode(',', $product['option']) as $key => $option) : ?>
                                    <option value="<?= $option ?>" <?= $key == 0 ? 'selected' : '' ?>><?= $option ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>


                        <p class="text-start mt-4">Quantité</p>
                        <div class="row">
                            <div class="col-lg-3 col-12">
                                <input id="quantityProduct" type="number" class="form-control" id="validationTooltip01" value="1" min="1" max="10" required>
                            </div>
                            <div class="col-lg-9 col-12 mt-lg-0 mt-3">
                                <?php if ($product['activated'] === '1') : ?>
                                    <button id="addToCart" type="button" class="btn btnBlueDark4 w-100" data-id="<?= $product['id'] ?>">Ajouter au panier</button>
                                <?php else : ?>
                                    <button type="button" class="btn btnBlueDark4 w-100" disabled>Momentanément indisponible</button>
                                <?php endif; ?>
                            </div>


                        </div>
                        <div class="text-start mt-5">
                            <p class="">
                                <i class="bi bi-arrow-left-right fw-bold h4 fs-3 me-3"></i> Satisfait ou remboursé
                            </p>
                            <p class="">
                                <i class="bi bi-truck fw-bold h4 fs-3 me-3"></i> Livraison offerte
                            </p>
                            <p class="">
                                <i class="bi bi-lock-fill fw-bold h4 fs-3 me-3"></i> Paiement sécurisé
                            </p>

                            <?= isset($_SESSION['id']) && $_SESSION['role'] == 2 ? '<p class="text-center"><a href="/views/admin/editProduct.php?id=' . $product["id"] . '">Editer la fiche produit</a></p>' : '' ?>



                        </div>

                    </div>

                </div>
            </div>
            <div class="col-12 mt-5">
                <p>
                    <button class="btn btnBlueDark4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Voir la description du produit <i class="bi bi-chevron-down"></i>
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <?= $product['longDescription'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header btnBlueDark3">

                <strong class="me-auto">Ajout au panier</strong>
                <small></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <img id="imgToast" src="../assets/img/products/pdt_60_6229f2bad56d3.webp" class="rounded me-2" alt="..." width="15%" height="15%">
                L'article a été ajouté a votre panier !
            </div>
        </div>
    </div>

    <script>
        Array.from(document.getElementsByClassName('imagesProduct')).forEach(value => {
            value.addEventListener('click', (e) => {
                if (e.target.nodeName == 'IMG') {

                    Array.from(document.getElementsByClassName('imagesProduct')).forEach(elt => {
                        elt.classList.remove('activeImg');
                    })

                    e.target.classList.add('activeImg')
                    document.getElementById('linkImageDisplay').href = e.target.src;
                    document.getElementById('imageDisplay').src = e.target.src;
                }
            })
        })
    </script>

</div>

<?php
include '../views/templates/footer.php';
?>