<!doctype html>
<html lang="fr">

<head>
    <title><?= $meta_title ?? '' ?></title>
    <meta name="description" content="<?= $meta_description ?? '' ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="/views/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="canonical" href="http://www.ecommerce.net/">
    <link href="../../assets/css/lightbox.css" rel="stylesheet" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://kit.fontawesome.com/cce27d2628.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>


<body class="bg-light" style="color: #141d37; margin-bottom: 80px; position: relative;">

    <header>
        <div class="" style="background: #267691;">
            <a href="home.php"><img class="img-fluid" src="../../assets/img/logosportxtrem.png" alt="Enseigne SportXtrem"></a>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white shadow">
            <div class="container-fluid">
                <a class="navbar-brand text-bluelight ms-lg-5 ms-0 d-lg-none d-block fs-1" href="../../views/home.php"><i class="bi bi-house-fill"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 h6">
                        <li class="nav-item dropdown text-bluedark ms-lg-5 ms-0">
                            <a class="nav-link text-bluedark" href="../../views/home.php">
                                <i class="bi bi-house-fill text-bluelight "> ACCUEIL</i>
                            </a>
                        </li>
                        <?php foreach ($Collections->getCollections() as $collections) : ?>
                            <li class="nav-item dropdown text-bluedark ms-lg-5 ms-0">
                                <a class="nav-link dropdown-toggle text-bluedark" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $collections['category']['name'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php foreach ($collections['collections'] as $collection) : ?>

                                        <li class=""><a class="dropdown-item" href="../../collection/all/1/<?= $collection['id'] ?>/<?= $collection['slug'] ?>"><?= $collection['name'] ?></a></li>

                                    <?php endforeach; ?>
                                </ul>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                    <div class="d-flex me-lg-5 me-0">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 h6">
                            <?php if (!isset($_SESSION['id'])) : ?>
                                <li class="nav-item dropdown text-bluedark me-lg-5 me-0">
                                    <a class="nav-link text-bluedark" href="login.php?action=connection">CONNEXION</a>
                                </li>
                            <?php else : ?>
                                <li class="nav-item dropdown text-bluedark me-lg-5 me-0">
                                    <a class="nav-link dropdown-toggle text-bluedark" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        MON COMPTE
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php if ($_SESSION['role'] == 2) : ?>
                                            <li>
                                                <a class="dropdown-item" href="../../views/admin/index.php">Administration</a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="dropdown-item" href="../../views/account.php">Votre compte</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../../views/orders.php">Vos commandes</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../../views/bills.php">Vos factures</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../../views/logout.php">Se déconnecter</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <button class="nav-link active" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-cart-check-fill"></i> MON PANIER</button>

                                <!-- <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-cart-check-fill"></i> </a> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

    </header>

    <main>