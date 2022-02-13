<?php
require_once '../controllers/ctrContact.php';
?>

<!doctype html>
<html lang="fr">

<head>
    <title>Page de contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>


<body class="bg-dark">

    <h1 class="text-center mt-5 text-white">Page de contact</h1>

    <div class="container mt-5">

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- Formulaire de contact -->

                    <div id="formConnection" class="col-lg-6 col m-auto">

                        <h2 class="card-title mb-5">Contactez-nous</h2>

                        <form class="text-start" method="POST" action="">

                            <?php if (isset($messageAlert)) : ?>

                                <div class="alert alert-<?= $messageAlert[0] ?> text-center" role="alert">
                                    <?= $messageAlert[1] ?>
                                </div>

                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Vos coordonnées pour être recontacté :</label>
                                <span class="text-danger"><?= $errors['fromName'] ?? '' ?></span>
                                <input type="text" name="fromName" class="form-control" id="exampleFormControlInput1" placeholder="Nom et prénom">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger"><?= $errors['fromMail'] ?? '' ?></span>
                                <input type="email" name="fromMail" class="form-control" id="exampleFormControlInput1" placeholder="mail@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Votre message (0 / 250):</label>
                                <span class="text-danger"><?= $errors['messageMail'] ?? '' ?></span>
                                <textarea name="messageMail" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                            </div>

                            <div class="row mt-3">
                                <span class="text-danger"><?= $errors['reCaptcha'] ?? '' ?></span>
                                <div class="g-recaptcha col-6" data-sitekey="6LdB5HAeAAAAAFSg6xSD0ZUXvFLUt2kSQB6cp5Zp"></div>
                                <div class="text-center mt-3 col-6">
                                    <input type="submit" name="sendMail" class="btn btn-dark" value="Envoyer">
                                </div>
                            </div>


                        </form>

                        <p>
                            <?php
                            var_dump($_POST);
                            ?>
                        </p>


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