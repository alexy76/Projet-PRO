<?php
require_once '../controllers/ctrNotFound.php';
include '../views/templates/header.php';
?>



<div class="container mt-3 text-bluedark">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb colorlink">
            <li class="breadcrumb-item colorlink"><a href="../../views/home.php">SportXtrem</a></li>
            <li class="breadcrumb-item active">404</li>
        </ol>
    </nav>

    <div class="card text-center" style="min-height: 70vh;">

        <div class="card-body">

            <div class="row justify-content-center p-lg-3 p-1">
                <h1>Erreur 404 : Page non trouvée !</h1>
            </div>
        </div>
    </div>
</div>

<?php
include '../views/templates/footer.php';
?>