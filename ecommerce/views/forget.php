<?php
require_once '../controllers/ctrForget.php';
?>

<!doctype html>
<html lang="fr">

<head>
    <title>Page de mot de passe oublié</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>


<body class="bg-dark">

    <h1 class="text-center mt-5 text-white">Page de Mot de passe oublié</h1>

    <div class="container mt-5">

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link colorlink" aria-current="true" href="login.php?action=connection">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link colorlink" href="login.php?action=subscribe">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="">Mot de passe oublié</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- Formulaire de mot de passe oublié -->

                    <div id="formConnection" class="col-lg-6 col m-auto">

                        <h2 class="card-title mb-5">Mot de passe oublié ?</h2>

                        <?php if (isset($messageAlert)) : ?>

                            <div class="alert alert-<?= $messageAlert[0] ?>" role="alert">
                                <?= $messageAlert[1] ?>
                            </div>

                        <?php endif; ?>


                        <p class="text-start">Vous avez perdu votre mot de passe ? Il vous suffit d'entrer votre adresse mail ci-dessous et vous recevrez un mail contenant un mot de passe temporaire afin de réinitialiser votre mot de passe.</p>
                        <form class="text-start" method="POST" action="">

                            <div class="mb-3">
                                <span class="text-danger"><?= $errors['mail'] ?? '' ?></span>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="mail@example.com" name="mail" value="">
                            </div>

                            <div class="mt-3">
                                <span class="text-danger"><?= $errors['reCaptcha'] ?? '' ?></span>
                                <div class="g-recaptcha" data-sitekey="6LdB5HAeAAAAAFSg6xSD0ZUXvFLUt2kSQB6cp5Zp"></div>
                            </div>

                            <div class="text-center mt-3">
                                <input type="submit" name="renewPwd" class="btn btn-dark" value="Renouveler mon mot de passe">
                            </div>

                        </form>

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