<?php
require_once '../controllers/ctrHome.php';
include_once '../views/templates/header.php';
?>

    <div class="text-center">

        <h1 class="text-white">Page Accueil</h1>

        <p class="mt-5"><a class="btn btn-dark text-white w-50" href="login.php">Fonctionnalité "Page de connexion / inscription"</a></p>
        <p class="mt-2"><a class="btn btn-secondary text-white w-50" href="forget.php">Fonctionnalité "Page de mot de passe oublié"</a></p>
        <p class="mt-2"><a class="btn btn-light w-50 border border-dark" href="contact.php">Fonctionnalité "Page Contactez-nous"</a></p>

    </div>



    <footer>
        <h3 class="text-white">Inscrivez-vous à notre Newsletter</h3>
        <form method="POST" action="">
            <div class="input-group mb-3 w-25">
                <input type="text" class="form-control d-inline-block" name="NewsLetterMail" placeholder="mail@example.com" aria-label="Recipient's username" aria-describedby="button-addon2">
                <!-- Voir le recaptcha plus tard -->
                <div class="g-recaptcha" data-sitekey="6Le-4HceAAAAAO_LO-NXQ-WDye4M9aIPQFO5laVH" data-size="invisible"></div>
                <button class="btn btn-dark" type="submit" id="button-addon2" name="subscribeNews">Button</button>
            </div>
        </form>
    </footer>



<?php
include_once '../views/templates/header.php';
?>