<?php
require_once '../controllers/ctrHome.php';
include '../views/templates/header.php';
?>
<div class="position-relative">
    <img src="../assets/img/homeimg.webp" class="d-block w-100" alt="..." width="800px">
    <div class="position-absolute top-50 start-50 translate-middle d-lg-block d-none">
        <p class="fs-1 text-white text-center">Découvrez tous nos articles !</p>

        <div class="buttons">

            <div class="containerglass">

                <a href="/collection/all/1/21/baskets" class="rounded btnglass effect02"><span>A PRIX MINI</span></a>
            </div>
        </div>

    </div>
</div>

<div class="container">



    <h1 class="text-center h2 mt-5 p-0">Nos collections vedettes</h1>



    <div class="row mt-5">
        <div class="col-lg-4 col-12 text-center mt-lg-0 mt-4">
            <div class="card">
                <img class="" src="../assets/img/products/pdt_38_6229cfef4af7f.webp" alt="">
                <h2 class="mt-2">Vestes</h2>
                <p><a class="colorlink2" href="/collection/all/1/18/vestes">Voir la collection</a></p>
            </div>
        </div>

        <div class="col-lg-4 col-12 text-center mt-lg-0 mt-4">
            <div class="card">
                <img class="rounded" src="../assets/img/products/pdt_64_6229f631ac6e7.webp" alt="">
                <h2 class="mt-2">Shorts</h2>
                <p><a class="colorlink2" href="/collection/all/1/20/shorts">Voir la collection</a></p>
            </div>
        </div>
        <div class="col-lg-4 col-12 text-center">
            <div class="card">
                <img class="" src="../assets/img/products/pdt_51_6229ddbbe860e.webp" alt="">
                <h2 class="mt-2">Maillots</h2>
                <p><a class="colorlink2" href="/collection/all/1/17/maillots">Voir la collection</a></p>
            </div>
        </div>
    </div>

</div>








<?php
include '../views/templates/footer.php';
?>