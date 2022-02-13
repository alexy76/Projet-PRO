<?php
require_once '../controllers/ctrHome.php';
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


<body>

    <div class="text-center">

        <h1>Page Accueil</h1>

        <p class="mt-5"><a class="btn btn-dark text-white w-50" href="login.php">Fonctionnalité "Page de connexion / inscription"</a></p>
        <p class="mt-2"><a class="btn btn-secondary text-white w-50" href="forget.php">Fonctionnalité "Page de mot de passe oublié"</a></p>

    </div>



    <footer>
        <h3>Inscrivez-vous à notre Newsletter</h3>
        <form method="POST" action="">
            <div class="input-group mb-3 w-25">
                <input type="text" class="form-control d-inline-block" name="NewsLetterMail" placeholder="mail@example.com" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-dark" type="submit" id="button-addon2" name="subscribeNews">Button</button>
            </div>
        </form>
    </footer>


    
    <?php if (isset($messageFlash)) : ?>
        <span id="messageFlash"></span>
    <?php endif; ?>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>