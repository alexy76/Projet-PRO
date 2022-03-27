<?php
require_once '../../controllers/admin/ctrProducts.php';
?>

<!doctype html>
<html lang="fr" class="m-0 p-0">

<head>

    <title>Administration</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/styleAdmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body class="m-0 p-0">


    <div class="card text-center border-dark text-white m-0 p-0" style="min-height: 100vh">


        <div class="card-header btnBlue pt-4 pb-4">
            <ul class="nav nav-tabs card-header-tabs bg-light mx-4 border-bottom border-light rounded-3">
                <li class="nav-item">
                    <a class="nav-link active btnBlueDark text-white" aria-current="true" href="">Administration</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link colorlink" href="../login.php">Retour sur le site</a>
                </li>
            </ul>
        </div>


        <div class="card-body bg-grey pt-5">
            <div class="row justify-content-evenly">
                <div class="col-lg-3 col-12 rounded-3 bg-light text-dark px-0" style="max-height: 165px;">
                    <div class="list-group bg-light">


                        <a href="./index.php" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                            <i class="bi bi-people"></i><span class="ms-3 d-inline-block m-auto">Gestion des utilisateurs</span>
                        </a>



                        <a href="./collections.php" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                            <i class="bi bi-folder-plus"></i></i><span class="ms-3 d-inline-block m-auto">Ajouter une collection</span>
                        </a>




                        <span class="list-group-item list-group-item-action btnBlueDark text-white d-inline-block text-start" aria-current="true">
                            <i class="bi bi-bag-plus-fill"></i><span class="ms-3 d-inline-block m-auto">Ajouter un produit</span>
                        </span>

                        <a href="" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                            <i class="bi bi-pencil-square"></i><span class="ms-3 d-inline-block m-auto">Modifier un produit</span>
                        </a>
                    </div>
                </div>



                <div class="col-lg-8 col-12 rounded-2 text-dark shadow bg-white pb-5">
                    <h1 class="mt-3 h6 fw-normal btnBlue text-white py-3 radius-bottom-left radius-top-right">Gestionnaire des produits</h1>

                    <h2 class="h5 mt-3 mb-3">Ajoutez un produit</h2>


                    <form class="input-group mb-3 w-100 mt-3" action="" method="POST">
                        <div class="input-group mb-3">
                            <input autocomplete="off" name="nameProduct" type="text" class="form-control form-control-sm" placeholder="Nom du produit" aria-label="Recipient's username" aria-describedby="button-addon2">

                            <select class="form-select form-select-sm" id="inputGroupSelect02" name="idColProduct">
                                <option selected disabled>Sélectionnez une collection</option>

                                <?php foreach ($listCollections as $collections) : ?>

                                    <optgroup label="<?= $collections['category'] ?>">

                                        <?php foreach ($collections['collections'] as $collection) : ?>

                                            <option value="<?= $collection['id'] ?>"><?= $collection['name'] ?></option>

                                        <?php endforeach; ?>

                                    </optgroup>

                                <?php endforeach; ?>
                            </select>

                            <button type="submit" name="addProduct" class="btn btnBlueDark btn-sm" for="inputGroupSelect02">Ajouter un produit</button>
                        </div>
                    </form>


                    <!-- <div class="input-group mt-4"> -->
                    <form action="" method="GET" class="w-100 input-group mt-4">
                        <input type="hidden" name="search" value="NameProduct">
                        <input id="nameProduct" type="text" list="res" value="<?= $req ?? '' ?>" class="form-control form-control-sm" placeholder="Nom du produit" name="req" autocomplete="off" onkeyup="getdata();">
                        <div class="input-group-append">
                            <button class="btn btn-sm btnBlueDark" type="submit">Rechercher</button>
                        </div>
                        <datalist id="res" style="width: 1000px;">
                        </datalist>
                    </form>

                    <!-- </div> -->

                    <div class="table-responsive rounded-3">
                        <table class="table table-light table-striped table-hover mt-4">
                            <thead class="">
                                <tr>
                                    <th class="btnBlue text-white text-start" scope="col">
                                        <input id="allCheckbox" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </th>
                                    <th class="btnBlue text-white text-start" scope="col">Nom du produit</th>
                                    <th class="btnBlue text-white text-start" scope="col">Collection</th>
                                    <th class="btnBlue text-white text-start" scope="col">Prix</th>
                                    <th class="btnBlue text-white" scope="col">En ligne</th>
                                    <th class="btnBlue text-white radius-top-right" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (!$getAllProducts) : ?>
                                    <tr>
                                        <th class="text-start" scope="row">Aucunes données trouvées</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        </td>
                                    </tr>
                                <?php else : ?>

                                    <?php foreach ($getAllProducts as $product) : ?>
                                        <tr>
                                            <td class="text-start">
                                                <input class="form-check-input inputDelete" type="checkbox" value="<?= $product->pdt_id ?>">
                                            </td>
                                            <th class="text-start" scope="row"><?= $product->pdt_title ?></th>
                                            <td class="text-start"><?= $product->col_name ?></td>
                                            <td class="text-start"><?= $product->pdt_price ?></td>
                                            <td><input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" <?= $product->pdt_activated == 1 ? 'checked' : '' ?> disabled></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btnBlueDark btn-sm dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-person-x-fill"></i> Action
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="./editProduct.php?id=<?= $product->pdt_id ?>">Editer la fiche produit</a>
                                                        </li>
                                                        <li>
                                                            <form class="m-0" method="POST" action="">
                                                                <input type="hidden" value="<?= $product->pdt_title ?>" name="nameProduct">
                                                                <input type="hidden" value="<?= $product->pdt_id ?>" name="idProduct">
                                                                <input class="d-inline-block w-100 linkBtnDeleteProduct px-2" type="submit" value="<?= $product->pdt_activated == 1 ? 'Désactiver la mise en ligne' : 'Mettre en ligne le produit' ?>" name="activateProduct">
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form id="deleteProductForm" class="m-0" method="POST" action="">
                                                                <input type="hidden" value="<?= $product->pdt_title ?>" name="nameProduct">
                                                                <input type="hidden" value="<?= $product->pdt_id ?>" name="idProduct">
                                                                <input class="d-inline-block w-100 linkBtnDelete px-2" type="submit" value="Supprimer le produit" name="deleteProduct">
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>

                        <form id="formInputsDelete" method="POST" action="" class="d-none">
                            <div id="inputGenerate">
                            </div>
                            <div class="text-end mb-3">
                                <!-- <input type="submit" value="Appliquer une remise" name="applyDiscountAll" class="btn btn-sm btn-light d-inline-block text-end"> -->
                                <input type="submit" value="Supprimer" name="deleteAll" class="btn btn-sm btn-danger d-inline-block text-end">
                            </div>
                        </form>


                        <nav class="text-center d-inline-block" aria-label="...">
                            <ul class="pagination">
                                <li class="page-item <?= $pageActual == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link <?= $pageActual == 1 ? '' : 'btnBlueDark' ?>" href="?search=<?= $nameMethod ?><?= isset($req) ? '&req=' . $req : '' ?>&page=<?= $pageActual - 1 ?>">Précédent</a>
                                </li>
                                <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                                    <li class="page-item">
                                        <a class="page-link <?= $i == $pageActual ? 'btnBlueDark' : 'text-dark' ?>" href="?search=<?= $nameMethod ?><?= isset($req) ? '&req=' . $req : '' ?>&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= $pageActual == $nbPages || ($pageActual == 1 && $nbPages == 0) ? 'disabled' : '' ?>">
                                    <a class="page-link <?= $pageActual == $nbPages || ($pageActual == 1  && $nbPages == 0) ? '' : 'btnBlueDark' ?>" href="?search=<?= $nameMethod ?><?= isset($req) ? '&req=' . $req : '' ?>&page=<?= $pageActual + 1 ?>">Suivant</a>
                                </li>
                            </ul>
                        </nav>


                    </div>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        document.getElementById('deleteProductForm').addEventListener('submit', (e) => {
            if (!window.confirm('Voulez-vous supprimer cet élement, cette action est irréversible')) {
                e.preventDefault();
            }
        })
    </script>
    <script type="text/javascript">
        document.getElementById('formInputsDelete').addEventListener('submit', (e) => {
            if (!window.confirm('Voulez-vous supprimer cet élement, cette action est irréversible')) {
                e.preventDefault();
            }
        })
    </script>
    <script type="text/javascript">
        function getdata() {

            var nameProduct = $('#nameProduct').val();

            if (nameProduct) {
                $.ajax({
                    type: 'post',
                    url: '../../controllers/ctrAjax.php',
                    data: {
                        nameProduct: nameProduct,
                    },
                    success: function(response) {
                        $('#res').html(response);
                    }
                });
            } else {
                $('#res').html("Entrez le nom de l'utilisateur");
            }
        }
    </script>
    <script type="text/javascript">
        if (<?= $flashMsg[0] ?? 'false' ?>) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                background: "#2e3c50",
                color: "#fff",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: "<?= $flashMsg[1] ?? '' ?>",
                title: "<?= $flashMsg[2] ?? '' ?>"
            })
        }
    </script>
    <script src="../../assets/js/deleteProducts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>