<?php
require_once '../controllers/ctrLogin.php';
?>

<!doctype html>
<html lang="fr">

<head>
    <title>Page de Connexion / Inscription</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>


<body class="bg-light">

    <h1 class="text-center">Page de Connexion / Inscription</h1>

    <div class="container">

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?= $action == 'connection' ? 'active' : '' ?>" aria-current="true" href="?action=connection">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $action == 'subscribe' ? 'active' : '' ?>" href="?action=subscribe">Inscription</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- Formulaire d'inscription -->

                    <div id="formSubscribe" class="col-6-lg col-10 m-auto <?= $action == 'subscribe' ? '' : 'd-none' ?>">

                        <h2 class="card-title mb-5">Créer un compte</h2>

                        <form class="text-start" method="POST" action="?action=subscribe">

                            <div class="mb-3">
                                <span class="text-danger"><?= $errors['lastName'] ?? '' ?></span>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre Nom" name="lastName" value="<?= $userSubscribe['lastName'] ?? '' ?>">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger"><?= $errors['firstName'] ?? '' ?></span>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre Prénom" name="firstName" value="<?= $userSubscribe['firstName'] ?? '' ?>">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger"><?= $errors['mail'] ?? '' ?></span>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="mail@example.com" name="mail" value="<?= $userSubscribe['mail'] ?? '' ?>">
                            </div>
                            <hr class="my-4 m-auto px-5" style="color: black; opacity: 100">
                            <div class="mb-3">
                                <span class="text-danger"><?= $errors['pwd'] ?? '' ?></span>
                                <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Mot de passe" name="pwd">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Confirmation mot de passe" name="pwdConfirm">
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input form-check-input-checked-dark form-check-input-checked-bg-dark" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="newsLetter" <?= isset($userSubscribe['newsLetter']) && $userSubscribe['newsLetter'] === true ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Je souhaite bénéficier des offres exclusives en m'inscrivant à la Newsletter !</label>
                            </div>
                            <div class="text-center mt-3">
                                <input type="submit" name="subscribe" class="btn btn-dark" value="S'inscrire">
                            </div>

                        </form>
                        <p class="card-text"></p>
                    </div>

                    <!-- Formulaire de connexion -->

                    <div id="formConnection" class="col-6-lg col-6 m-auto <?= $action == 'connection' ? '' : 'd-none' ?>">

                        <h2 class="card-title mb-5">Se connecter à son compte</h2>

                        <?php if(isset($messageAlert)) : ?>

                                <div class="alert alert-<?= $messageAlert[0] ?>" role="alert">
                                    <?= $messageAlert[1] ?>
                                </div>

                        <?php endif; ?>

                        <form class="text-start" method="POST" action="?action=connection">
                            <div class="mb-3">
                                <span class="text-danger"></span>
                                <input type="mail" class="form-control" id="exampleFormControlInput1" placeholder="mail@example.com" name="mail" value="<?= $mail ?? '' ?>">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger"></span>
                                <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Mot de passe" name="pwd" value="">
                            </div>

                            <div class="text-center mt-3">
                                <input type="submit" name="connection" class="btn btn-dark" value="Se connecter">
                            </div>

                        </form>
                        <p class="card-text"></p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <?php if (isset($messageFlash)) : ?>
        <span id="messageFlash"></span>
    <?php endif; ?>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>