<?php
require_once '../controllers/ctrContact.php';
include '../views/templates/header.php';
?>


    <div class="container mt-3">

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
                                <label for="" class="form-label">Vos coordonnées pour être recontacté :</label>
                                <br><span class="text-danger"><?= $errors['fromName'] ?? '' ?></span>
                                <input type="text" name="fromName" class="form-control" id="" placeholder="Nom et prénom" value="<?= isset($_SESSION['id']) ? $_SESSION['firstname'].' '.$_SESSION['lastname'] : (isset($formContact['fromName']) ? $formContact['fromName'] : '') ?>">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger"><?= $errors['fromMail'] ?? '' ?></span>
                                <input type="email" name="fromMail" class="form-control" id="" placeholder="mail@example.com" value="<?= isset($_SESSION['id']) ? $_SESSION['mail'] : (isset($formContact['fromMail']) ? $formContact['fromMail'] : '') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="textContact" class="form-label">Votre message (<span id="nbChars">0</span> / 500):</label>
                                <br><span class="text-danger"><?= $errors['messageMail'] ?? '' ?></span>
                                <textarea name="messageMail" class="form-control" id="textContact" rows="6"><?= $formContact['messageMail'] ?? '' ?></textarea>
                            </div>

                            <div class="row mt-3">
                                <span class="text-danger"><?= $errors['reCaptcha'] ?? '' ?></span>
                                <div class="g-recaptcha col-6" data-sitekey="6LdB5HAeAAAAAFSg6xSD0ZUXvFLUt2kSQB6cp5Zp"></div>
                                <div class="text-center mt-3 col-6">
                                    <input type="submit" name="sendMail" class="btn btn-dark" value="Envoyer">
                                </div>
                            </div>


                        </form>


                    </div>
                </div>

            </div>
        </div>

    </div>

<?php
include '../views/templates/footer.php';
?>