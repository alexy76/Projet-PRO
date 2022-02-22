<?php
require_once '../../controllers/admin/ctrCollections.php';
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


                        <span class="list-group-item list-group-item-action btnBlueDark text-white d-inline-block text-start" aria-current="true">

                            <i class="bi bi-folder-plus"></i></i><span class="ms-3 d-inline-block m-auto">Ajouter une collection</span>
                        </span>




                        <a href="" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                            <i class="bi bi-bag-plus-fill"></i><span class="ms-3 d-inline-block m-auto">Ajouter un produit</span>
                        </a>
                        <a href="" class="list-group-item list-group-item-action bg-light d-inline-block text-start">
                            <i class="bi bi-pencil-square"></i><span class="ms-3 d-inline-block m-auto">Modifier un produit</span>
                        </a>
                    </div>
                </div>



                <div class="col-lg-8 col-12 rounded-2 text-dark shadow bg-white pb-5">
                    <h1 class="mt-3 h6 fw-normal btnBlue text-white py-3 radius-bottom-left radius-top-right">Gestionnaire des catégories</h1>

                    <h2 class="h5 mt-3 mb-3">Ajoutez une catégorie</h2>


                    <form class="input-group mb-3 w-100 mt-3" action="" method="POST">
                        <input id="exampleFormControlInput1" autocomplete="off" name="nameCategory" type="text" class="form-control form-control-sm" placeholder="Nom de la catégorie" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btnBlueDark btn-sm" type="submit" id="button-addon2" name="addCategory">Ajouter une catégorie</button>
                    </form>

                    <?php if (!empty($listCategory)) : ?>

                        <h2 class="h5 mt-3 mb-3">Ajoutez une collection</h2>


                        <form class="input-group mb-3 w-100 mt-3" action="" method="POST">
                            <div class="input-group mb-3">
                                <input autocomplete="off" name="nameCollection" type="text" class="form-control form-control-sm" placeholder="Nom de la collection" aria-label="Recipient's username" aria-describedby="button-addon2">

                                <select class="form-select form-select-sm" id="inputGroupSelect02" name="catCollection">
                                    <option selected disabled>Sélectionner une catégorie</option>

                                    <?php foreach ($listCategory as $category) : ?>

                                        <option value="<?= $category->cat_id ?>"><?= $category->cat_name ?></option>

                                    <?php endforeach; ?>
                                </select>

                                <button type="submit" name="addCollection" class="btn btnBlueDark btn-sm" for="inputGroupSelect02">Ajouter une collection</button>
                            </div>
                        </form>

                        <h2 class="mt-4">Personnalisation de la Navbar</h2>
                        <button id="positionSaveCategory" type="button" class="link-button mb-3" title="Sauvegarder la position">Sauvegarder la position des catégories</button>

                        <div id="wrapperCategory" class="row justify-content-evenly">
                            <?php foreach ($listCollections as $key => $catcol) : ?>

                                <div class="col-lg-3 col-6 px-2 mt-5" data-idCategory="<?= $catcol['category']['id'] ?>">




                                    <div class="border border-light border-2 bg-grey shadow" style="height: 100%">
                                        <h3 class="m-0 h4 btnBlueDark py-2 rounded"><?= $catcol['category']['name'] ?></h2>
                                            <div class="text-end">
                                                <button id="positionSave<?= $key ?>" type="button" class="link-button mb-3" title="Sauvegarder la position"><i class="colorlink bi bi-save-fill"></i></button>
                                            </div>
                                            <div id="wrapper<?= $key ?>" ?><?php foreach ($catcol['collections'] as $collections) : ?><div data-idCollection="<?= $collections['id'] ?>" class="list btnBlueDarkOutline rounded py-2 mx-3 mb-2" style="cursor: grab;"><span class=""><?= $collections['name'] ?></span></div><?php endforeach; ?></div>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                    <?php else : ?>

                        <div class="alert alert-info mt-3">Une catégorie doit être créée avant d'ajouter une collection</div>

                    <?php endif; ?>






                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function getdata() {

            var name = $('#name').val();

            if (name) {
                $.ajax({
                    type: 'post',
                    url: '../../controllers/ctrAjax.php',
                    data: {
                        name: name,
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
        if (<?= $flashToast ?? 'false' ?>) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'middle-middle',
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
    <script src="../../assets/js/sortable.js"></script>
    <script>
        new Sortable(document.getElementById('wrapperCategory'), {
            animation: 300
        })
        document.getElementById('positionSaveCategory').addEventListener('click', () => {

            let arraySetPositionCategoryAjax = [];

            document.getElementById('wrapperCategory').childNodes.forEach(elt => {

                if (elt.nodeName == 'DIV') {

                    arraySetPositionCategoryAjax.push(elt.dataset.idcategory)
                }
            })

            if (arraySetPositionCategoryAjax.length > 1) {
                $.ajax({
                    type: 'post',
                    url: '../../controllers/ctrAjax.php',
                    data: {
                        positionCategory: arraySetPositionCategoryAjax,
                    },
                    success: function(response) {

                        if (response == 'ok') {
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
                                icon: 'success',
                                title: 'Les changements ont été effectués !'
                            })
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'center',
                                background: "#2e3c50",
                                color: "#fff",
                                showConfirmButton: false,
                                timer: 10000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: `La position des IDs ${response} n'ont pas étés modifiés !`
                            })
                        }
                    }
                });
            } else {
                console.log('pas ok');
            }
        })
    </script>
    <script>
        <?php for ($i = 0; $i < count($listCollections); $i++) : ?>

            new Sortable(document.getElementById('wrapper<?= $i ?>'), {
                animation: 300
            })

            document.getElementById('positionSave<?= $i ?>').addEventListener('click', () => {

                let arraySetAjax = [];

                document.getElementById('wrapper<?= $i ?>').childNodes.forEach(index => {

                    arraySetAjax.push(index.dataset.idcollection)
                })

                if (arraySetAjax.length > 1) {
                    $.ajax({
                        type: 'post',
                        url: '../../controllers/ctrAjax.php',
                        data: {
                            position: arraySetAjax,
                        },
                        success: function(response) {

                            if (response == 'ok') {
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
                                    icon: 'success',
                                    title: 'Les changements ont été effectués !'
                                })
                            } else {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'center',
                                    background: "#2e3c50",
                                    color: "#fff",
                                    showConfirmButton: false,
                                    timer: 10000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: `La position des IDs ${response} n'ont pas étés modifiés !`
                                })
                            }
                        }
                    });
                } else {
                    console.log('pas ok');
                }
            })

        <?php endfor; ?>
    </script>
    <script src="../../assets/js/appAdmin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>