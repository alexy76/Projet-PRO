<?php
require_once '../controllers/ctrAccount.php';
include '../views/templates/header.php';
?>

<a href="/" class="linklogin">
    <h1 class="text-center mt-5 text-white">Compte client</h1>
</a>

<div class="container mt-5">

    <div class="card text-center">
        <div class="card-header">

            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="logout.php">Déconnexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="">Mon compte</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-lg-4 col-12">
                    <div class="list-group">
                        <a href="account.php" class="list-group-item list-group-item-action bg-dark text-white disabled" aria-current="true">
                            Mon compte client
                        </a>
                        <a href="orders.php" class="list-group-item list-group-item-action">Mes commandes</a>
                        <a href="bills.php" class="list-group-item list-group-item-action">Mes factures</a>
                    </div>
                </div>
                <div class="col-lg-8 col-12">

                </div>


            </div>

        </div>
    </div>

</div>

<?php
include '../views/templates/footer.php';
?>