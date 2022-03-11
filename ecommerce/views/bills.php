<?php
require_once '../controllers/ctrAccount.php';
include '../views/templates/header.php';
?>

<div class="container mt-3">

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
                        <a href="account.php" class="list-group-item list-group-item-action" aria-current="true">
                            Mon compte client
                        </a>
                        <a href="orders.php" class="list-group-item list-group-item-action">Mes commandes</a>
                        <a href="bills.php" class="list-group-item list-group-item-action  bg-dark text-white disabled">Mes factures</a>
                    </div>

                    <p class="mt-3 fw-light">Inscrit(e) depuis le <span class=""><?= date('d/m/Y', strtotime($_SESSION['registered'])) ?></span></p>

                    <div class="list-group mb-4">
                        <a href="contact.php" class="btn btn-outline-dark" aria-current="true">
                            Nous contacter
                        </a>
                    </div>
                    
                    <?php if ($_SESSION['newsletters'] == 0) : ?>
                        <div class="card">
                            <img src="../assets/img/newsletters.png" class="card-img-top" alt="Solde">
                            <div class="card-body">
                                <h5 class="card-title">Profitez-en maintenant</h5>
                                <p class="card-text">En s'inscrivant à notre Newsletter, vous bénéficierez d'offres exceptionnelles</p>
                                <a href="?action=subscribeNewsletters" class="btn btn-outline-info">Je profite des offres privées</a>
                            </div>
                        </div>
                    <?php endif; ?>
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