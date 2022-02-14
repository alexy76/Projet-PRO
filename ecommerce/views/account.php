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
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Modifier mes informations client
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">

                                    <?php if (isset($messageAlertName)) : ?>

                                        <div class="alert alert-<?= $messageAlertName[0] ?>" role="alert">
                                            <?= $messageAlertName[1] ?>
                                        </div>

                                    <?php endif; ?>

                                    <form class="mt-3" method="POST" action="">
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Modifier mon mot de passe
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">

                                    <form class="mt-3" method="POST" action="">
                                        <div class="mb-3">
                                            <input type="text" name="oldPassword" class="form-control" placeholder="Mot de passe actuel">
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <input type="text" name="newPassword" class="form-control" placeholder="Nouveau mot de passe">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="confirmNewPassword" class="form-control" placeholder="Confirmation du nouveau mot de passe">
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Modifier mon adresse de livraison
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">

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