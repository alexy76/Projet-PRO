<?php
require_once '../controllers/ctrProduct.php';
include '../views/templates/header.php';
?>

<div class="container mt-3 text-bluedark">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb colorlink">
            <li class="breadcrumb-item colorlink"><a href="../../views/home.php">SportXtrem</a></li>
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
                            <div class="col-lg-3">
                                <input id="quantityProduct" type="number" class="form-control" id="validationTooltip01" value="1" required>
                            </div>
                            <div class="col-lg-9">
                                <button id="addToCart" type="button" class="btn btnBlueDark2 w-100" data-id="<?= $product['id'] ?>" data-title="<?= $product['title'] ?>" data-price="<?= $product['price'] ?>" data-discount="<?= $product['discount'] ?>">Ajouter au panier</button>
                            </div>

                            <script>
                                document.getElementById('addToCart').addEventListener('click', (e) => {

                                    //console.log(e.target.dataset);
                                    //console.log(document.getElementById('quantityProduct').value)
                                    //console.log(document.getElementById('optionProduct').value)

                                    // Permet de récupérer les infos du produit en fonction de l'ID
                                    // Retourne "false" si l'ID n'éxiste pas
                                    $.ajax({
                                        type: 'post',
                                        url: '../controllers/ctrCartAjax.php',
                                        data: {
                                            idProduct: e.target.dataset.id
                                        },
                                        success: function(response) {
                                            //$('#res').html(response);
                                            //console.log(response);
                                            if (response == 'false') {

                                                console.log("id existe pas");

                                            } else {

                                                if (localStorage.getItem('cart') === null) {
                                                    localStorage.setItem('cart', 'empty');
                                                }

                                                responseArray = JSON.parse(response);
                                                let cart = {
                                                    id: responseArray.id,
                                                    image: responseArray.images[0],
                                                    title: responseArray.title,
                                                    option: document.getElementById('optionProduct').value,
                                                    quantity: parseInt(document.getElementById('quantityProduct').value)
                                                }

                                                if (localStorage.getItem('cart') === 'empty') {

                                                    localStorage.setItem('cart', JSON.stringify([cart]))
                                                } else {

                                                    let doublon = false

                                                    arrayCart = JSON.parse(localStorage.getItem('cart'))

                                                    arrayCart.forEach(elt => {

                                                        if (elt.id == responseArray.id && document.getElementById('optionProduct').value != elt.option) {

                                                            doublon = true

                                                            arrayCart.push(cart);
                                                            localStorage.setItem('cart', JSON.stringify(arrayCart))
                                                            console.log(JSON.parse(localStorage.getItem('cart')))
                                                            return

                                                        } else if (elt.id == responseArray.id && document.getElementById('optionProduct').value == elt.option) {
                                                            elt.quantity = parseInt(elt.quantity) + parseInt(document.getElementById('quantityProduct').value)
                                                            localStorage.setItem('cart', JSON.stringify(arrayCart))
                                                            console.log(JSON.parse(localStorage.getItem('cart')))
                                                            return
                                                        }
                                                    })

                                                    console.log(doublon)
                                                    if (!doublon) {
                                                        arrayCart.push(cart);
                                                        localStorage.setItem('cart', JSON.stringify(arrayCart))
                                                        console.log(JSON.parse(localStorage.getItem('cart')))
                                                    }
                                                }

                                            }
                                        }
                                    });

                                })
                            </script>

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


                        </div>

                    </div>

                </div>
            </div>
            <div class="col-12 mt-5">
                <p>
                    <button class="btn btnBlueDark2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
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