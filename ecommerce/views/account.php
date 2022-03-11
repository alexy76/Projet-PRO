<?php
require_once '../controllers/ctrAccount.php';
include '../views/templates/header.php';
?>

<div class="container mt-3">

    <div class="card text-center">
        <div class="card-header">

            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="login.php">Debug session</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="logout.php">Déconnexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="">Mon compte</a>
                </li>
                <?php if ($_SESSION['role'] == 2) : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="true" href="admin/index.php">Panel Admin</a>
                    </li>
                <?php endif; ?>
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
                <div class="col-lg-8 col-12 mt-lg-0 mt-4">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button id="profil" class="accordion-button <?= isset($messageAlertAddress) || isset($messageAlertPassword) ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="<?= isset($messageAlertAddress) || isset($messageAlertPassword) ? 'false' : 'true' ?>" aria-controls="panelsStayOpen-collapseOne">
                                    Modifier mes informations client
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse <?= isset($messageAlertAddress) || isset($messageAlertPassword) ? '' : 'show' ?>" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">

                                    <?php if (isset($messageAlertName)) : ?>

                                        <div class="alert alert-<?= $messageAlertName[0] ?>" role="alert">
                                            <?= $messageAlertName[1] ?>
                                        </div>

                                    <?php endif; ?>

                                    <form class="mt-3" method="POST" action="account.php#profil">
                                        <div class="mb-3">
                                            <input class="form-control" type="text" value="<?= $_SESSION['mail'] ?>" aria-label="readonly input example" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="lastName" class="form-control" id="exampleFormControlInput1" placeholder="Prénom" value="<?= $_SESSION['lastname'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="firstName" class="form-control" id="exampleFormControlInput1" placeholder="Nom de famille" value="<?= $_SESSION['firstname'] ?>">
                                        </div>
                                        <div class="mt-3">
                                            <input type="submit" name="modifyProfilName" class="btn btn-dark" value="Modifier">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button id="modifyPwd" class="accordion-button <?= isset($messageAlertPassword) ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="<?= isset($messageAlertPassword) ? 'true' : 'false' ?>" aria-controls="panelsStayOpen-collapseTwo">
                                    Modifier mon mot de passe
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse <?= isset($messageAlertPassword) ? 'show' : '' ?>" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">

                                    <?php if (isset($messageAlertPassword)) : ?>

                                        <div class="alert alert-<?= $messageAlertPassword[0] ?>" role="alert">
                                            <?= $messageAlertPassword[1] ?>
                                        </div>

                                    <?php endif; ?>

                                    <form class="mt-3" method="POST" action="account.php#modifyPwd">
                                        <div class="mb-3">
                                            <input type="password" name="oldPassword" class="form-control" placeholder="Mot de passe actuel">
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <input type="password" name="newPassword" class="form-control" placeholder="Nouveau mot de passe">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="confirmNewPassword" class="form-control" placeholder="Confirmation du nouveau mot de passe">
                                        </div>
                                        <div class="mt-3">
                                            <input type="submit" name="modifyPassword" class="btn btn-dark" value="Modifier">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button id="modifyAdress" class="accordion-button <?= isset($messageAlertAddress) ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="<?= isset($messageAlertAddress) ? 'true' : 'false' ?>" aria-controls="panelsStayOpen-collapseThree">
                                    Modifier mon adresse de livraison
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse <?= isset($messageAlertAddress) ? 'show' : '' ?>" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <?php if (isset($messageAlertAddress)) : ?>

                                        <div class="alert alert-<?= $messageAlertAddress[0] ?>" role="alert">
                                            <?= $messageAlertAddress[1] ?>
                                        </div>

                                    <?php endif; ?>

                                    <form class="mt-3 text-start" method="POST" action="account.php#modifyAdress">
                                        <div class="mb-3">
                                            <span class="text-danger"><?= $errors['address'] ?? '' ?></span>
                                            <input type="text" name="address" class="form-control" placeholder="Adresse complète" value="<?= isset($address['address']) ? $address['address'] : $_SESSION['address']  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-danger"><?= $errors['zipCode'] ?? '' ?></span>
                                            <input type="text" name="zipCode" class="form-control" placeholder="Code postal" value="<?= isset($address['zipCode']) ? $address['zipCode'] : $_SESSION['zipcode']  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-danger"><?= $errors['city'] ?? '' ?></span>
                                            <input type="text" name="city" class="form-control" placeholder="Ville" value="<?= isset($address['city']) ? $address['city'] : $_SESSION['city']  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-danger"><?= $errors['country'] ?? '' ?></span>
                                            <input type="text" name="country" class="form-control" placeholder="Pays" value="<?= isset($address['country']) ? $address['country'] : $_SESSION['country']  ?>">
                                        </div>
                                        <div class="mt-3 text-center">
                                            <input type="submit" name="modifyAddress" class="btn btn-dark" value="Modifier">
                                            <a href="?action=deleteAddr#modifyAdress" class="btn btn-outline-dark">Supprimer mon adresse</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

</div>

<?php
include '../views/templates/footer.php';
?>