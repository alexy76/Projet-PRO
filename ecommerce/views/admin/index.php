<?php
require_once '../../controllers/admin/ctrIndex.php';
?>

<!doctype html>
<html lang="fr">

<head>
    <title>Administration</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/styleAdmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>


<body class="bgadmin">

    <div class="container">
        <div class="card text-center border-dark text-white mx-lg-5 mx-0" style="min-height: 100vh">


            <div class="card-header btnBlue pt-4 pb-4">
                <ul class="nav nav-tabs card-header-tabs bg-light mx-4 border-bottom border-light rounded-3">
                    <li class="nav-item">
                        <a class="nav-link active btnBlue text-white" aria-current="true" href="">Administration</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link colorlink" href="../login.php">Retour sur le site</a>
                    </li>
                </ul>
            </div>


            <div class="card-body bg-white pt-5">
                <div class="row justify-content-evenly">
                    <div class="col-lg-3 col-12 rounded-3 bg-light text-dark px-0" style="max-height: 250px;">
                        <div class="list-group bg-light">
                            <a href="index.php" class="list-group-item list-group-item-action btnBlue text-white d-inline-block text-start" aria-current="true">
                                <i class="bi bi-people"></i><span class="ms-3 d-inline-block m-auto">Gestion des utilisateurs</span>
                            </a>
                            <a href="" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                                <i class="bi bi-folder-plus"></i></i><span class="ms-3 d-inline-block m-auto">Ajouter une collection</span>
                            </a>
                            <a href="" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                                <i class="bi bi-bag-plus-fill"></i><span class="ms-3 d-inline-block m-auto">Ajouter un produit</span>
                            </a>
                            <a href="" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                                <i class="bi bi-pencil-square"></i><span class="ms-3 d-inline-block m-auto">Modifier un produit</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 rounded-2 text-dark shadow">
                        <h1 class="mt-3 h6 fw-normal btnBlue text-white py-3 radius-bottom-left radius-top-right">Gestionnaire des utilisateurs</h1>


                        <div class="input-group mt-4">
                            <form action="?search=NameClient" method="POST" class="w-100">
                                <input type="text" class="form-control form-control-sm" placeholder="Nom du client" name="req">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btnBlue" type="submit">Rechercher</button>
                                </div>
                            </form>

                        </div>

                        <a href="?search=AccountNotActivated">Afficher les comptes non activé</a>

                        <div class="table-responsive rounded-3">
                            <table class="table table-light table-striped table-hover mt-4">
                                <thead class="">
                                    <tr>
                                        <th class="btnBlue text-white text-start" scope="col">Mail</th>
                                        <th class="btnBlue text-white text-start" scope="col">Nom</th>
                                        <th class="btnBlue text-white" scope="col">Activé</th>
                                        <th class="btnBlue text-white" scope="col">Newsletters</th>
                                        <th class="btnBlue text-white radius-top-right" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$getAllClients) : ?>
                                        <tr>
                                            <th class="text-start" scope="row">Aucunes données trouvées</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                            </td>
                                        </tr>
                                        <?php
                                    else :
                                        foreach ($getAllClients as $user) : ?>
                                            <tr>
                                                <th class="text-start" scope="row"><?= $user->usr_mail ?></th>
                                                <td class="text-start"><?= $user->usr_firstname ?></td>
                                                <td><input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" <?= $user->usr_account_activate == 1 ? 'checked' : '' ?> disabled></td>
                                                <td><input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" <?= $user->usr_accept_newsletters == 1 ? 'checked' : '' ?> disabled></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btnBlue btn-sm dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-person-x-fill"></i> Action
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#">Voir ses commandes</a></li>
                                                            <li><a class="dropdown-item" href="#">Supprimer l'utilisateur</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <nav class="text-center d-inline-block" aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item <?= $pageActual == 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?search=<?= $nameMethod ?>&req=<?= $req ?? '' ?>&page=<?= $pageActual - 1 ?>">Previous</a>
                                    </li>
                                    <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                                        <li class="page-item">
                                            <a class="page-link <?= $i == $pageActual ? 'btnBlue text-white' : 'text-dark' ?>" href="?search=<?= $nameMethod ?>&req=<?= $req ?? '' ?>&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?= $pageActual == $nbPages ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?search=<?= $nameMethod ?>&req=<?= $req ?? '' ?>&page=<?= $pageActual + 1 ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>