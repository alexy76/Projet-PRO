<?php
require_once '../controllers/ctrHome.php';
include '../views/templates/header.php';
?>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../assets/img/carroussel1.webp" class="d-block w-100" alt="..." width="800px">
        </div>
        <div class="carousel-item">
            <img src="../assets/img/carroussel2.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../assets/img/carroussel3.webp" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="text-center">

    <a href="/" class="linklogin">
        <h1 class="text-white">Page Accueil</h1>
    </a>

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
include '../views/templates/footer.php';
?>