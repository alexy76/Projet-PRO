<?php
require_once '../../controllers/admin/ctrEditProduct.php';
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
                    <h1 class="mt-3 h6 fw-normal btnBlue text-white py-3 radius-bottom-left radius-top-right">Edition du produit</h1>

                    <div class="row my-3">
                        <div class="col-lg-6 col-12 text-start">
                            <a href="<?= $_SERVER['HTTP_REFERER'] ?? './products.php' ?>" class="btn btn-sm btnBlueDark">Retour</a>
                        </div>
                        <div class="col-lg-6 col-12 text-lg-end pt-lg-0 pt-3">
                            <div class="form-switch">
                                <input class="form-check-input d-inline-block me-2" type="checkbox" role="switch" data-id="<?= $product['pdt_id'] ?>" id="flexSwitchCheckDefault" <?= $product['pdt_activated'] == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexSwitchCheckDefault"><?= $product['pdt_activated'] == 1 ? 'Désactiver la mise en ligne du produit' : 'Mettre en ligne le produit' ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        if (<?= $flashToast ?? 'false' ?>) {

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
                icon: '<?= $flashMsg[0] ?? '' ?>',
                title: '<?= $flashMsg[1] ?? '' ?>'
            })
        }
    </script>
    <script>
        flexSwitchCheckDefault.addEventListener('change', () => {

            $.ajax({
                type: 'post',
                url: '../../controllers/ctrAjax.php',
                data: {
                    statusProduct: flexSwitchCheckDefault.checked ? 1 : 0,
                    idProduct : flexSwitchCheckDefault.dataset.id
                },
                success: function(response) {
                }
            });

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>