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
                    <div class="col-3 d-lg-none d-block">
                        <img class="img-fluid mb-3 imagesProduct <?= $key == 0 ? 'activeImg' : '' ?>" src="../../assets/img/products/<?= $images['image'] ?>" alt="<?= $images['alt'] ?>">
                    </div>
                <?php endforeach; ?>

                <div class="col-lg-6">
                    <h1 class="h3"><?= $product['title'] ?></h1>
                    <div class="px-5 mt-5">
                        <p class="text-start">Quantité</p>
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="number" class="form-control" id="validationTooltip01" value="1" required>
                            </div>
                            <div class="col-lg-9">
                                <button type="button" class="btn btnBlueDark2 w-100">Ajouter au panier</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12">
                kdheloihefl
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