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
    <link href="../../assets/css/lightbox.css" rel="stylesheet" />

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
                    <h1 class="mt-3 h6 fw-normal btnBlue text-white py-2 radius-bottom-left radius-top-right"><i class="bi bi-pencil-square"></i> Modification du produit</h1>

                    <div class="row my-2">
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



                    <h3 class="mb-5"><?= $product['pdt_title'] ?></h3>


                    <div class="row mt-3 text-start g-0">



                        <div class="col-lg-6 col-12 px-4 border-grey">
                            <h4 class="text-center my-3">Informations générales du produit</h4>
                            <form class="input-group mb-3 w-100 mt-3" action="" method="POST">

                                <label for="exampleFormControlInput1" class="form-label form-label-sm">Nom du produit</label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="Nom du produit" value="<?= $product['pdt_title'] ?>" name="nameProduct">

                                    <button type="submit" name="changeName" class="btn btnBlueDark btn-sm">Enregistrer</button>
                                </div>
                            </form>

                            <form class="input-group mb-3 w-100 mt-3" action="" method="POST">

                                <label for="inputGroupSelect02" class="form-label form-label-sm">Choisir une collection</label>

                                <div class="input-group mb-3">

                                    <select class="form-select form-select-sm" id="inputGroupSelect02" name="idColProduct">
                                        <option disabled>Sélectionnez une collection</option>

                                        <?php foreach ($listCollections as $collections) : ?>

                                            <optgroup label="<?= $collections['category'] ?>">

                                                <?php foreach ($collections['collections'] as $collection) : ?>

                                                    <option value="<?= $collection['id'] ?>" <?= $collection['id'] == $product['col_id'] ? 'selected' : '' ?>><?= $collection['name'] ?></option>

                                                <?php endforeach; ?>

                                            </optgroup>

                                        <?php endforeach; ?>
                                    </select>

                                    <button type="submit" name="changeCollection" class="btn btnBlueDark btn-sm" for="inputGroupSelect02">Enregistrer</button>
                                </div>
                            </form>


                            <form class="input-group mb-3 w-100 mt-3" action="" method="POST">

                                <label for="" class="form-label form-label-sm">Prix de vente</label>

                                <div class="input-group input-group-sm mb-3">

                                    <span class="input-group-text">Prix €</span>
                                    <input type="text" value="<?= $product['pdt_price'] ?>" class="form-control" aria-label="Amount (to the nearest dollar)" name="price">
                                    <span class="input-group-text">Remise %</span>
                                    <input type="text" value="<?= $product['pdt_discount'] ?>" class="form-control" aria-label="Amount (to the nearest dollar)" name="discount" placeholder="Saisir une remise">
                                    <button type="submit" name="changePrice" class="btn btnBlueDark btn-sm">Enregistrer</button>

                                </div>

                            </form>


                            <form class="input-group mb-3 w-100 mt-3" action="" method="POST">

                                <label for="exampleFormControlInput2" class="form-label form-label-sm">Options</label>

                                <div class="input-group mb-3">

                                    <input type="text" class="form-control form-control-sm" id="exampleFormControlInput2" placeholder="ex : XS,S,L,XL,XXL" value="<?= $product['pdt_option'] ?>" name="optionProduct">

                                    <button type="submit" name="changeOption" class="btn btnBlueDark btn-sm">Enregistrer</button>
                                </div>
                            </form>








                        </div>
                        <div class="col-lg-6 col-12 px-4 bg-grey">
                            <h4 class="text-center my-3">Améliorer son référencement</h4>

                            <div class="arial shadow p-2 rounded mt-3 bg-white">
                                <?php //var_dump($_SERVER); 
                                ?>
                                <p class="arial m-0">https://www.<?= $_SERVER['HTTP_HOST'] ?> › <span class="greyGoogle">collection...</a></p>
                                <p class="arial m-0 h5 fw-bold"><a id="displayTitleGoogle" class="underline" href=""><?= !is_null($product['pdt_meta_title']) ? $product['pdt_meta_title'] : 'Bague Tête de Mort | Crâne Faction' ?></a></p>
                                <p id="displayDescriptionGoogle" class="arial m-0 greyGoogle"><?= !is_null($product['pdt_meta_description']) ? $product['pdt_meta_description'] : 'Nos Bagues Têtes de Mort forgées dans les entrailles de l\'enfer vont te faire craquer. Biker dissident, punk, métalleux énervé ou gothique : bienvenue !' ?></p>

                            </div>


                            <form method="POST" action="" class="mb-3">
                                <div class="my-3">
                                    <label for="metaTitle" class="form-label">Méta Titre (<span id="nbCharsTitle">0</span>/60)</label>
                                    <input type="text" class="form-control form-control-sm" id="metaTitle" value="<?= !is_null($product['pdt_meta_title']) ? $product['pdt_meta_title'] : '' ?>" placeholder="Ex: Mon produit | Ecommerce.net">
                                </div>

                                <div class="mb-3">
                                    <label for="metaDescription" class="form-label">Méta Description (<span id="nbCharsDescription">0</span>/150)</label><br>
                                    <textarea class="form-control" placeholder="Décrivez votre produit en quelques mots" id="metaDescription" style="height: 100px"><?= !is_null($product['pdt_meta_description']) ? $product['pdt_meta_description'] : '' ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="slugProduct" class="form-label">Slug URL de la page du produit</label>
                                    <input id="slugProduct" value="<?= !is_null($product['pdt_slug']) ? $product['pdt_slug'] : '' ?>" class="form-control form-control-sm" type="text" placeholder="Le slug URL est généré automatiquement avec le nom du produit" aria-label="Disabled input example" disabled>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="changeOption" class="btn btnBlueDark btn-sm">Enregistrer</button>
                                </div>

                            </form>

                        </div>
                    </div>


                    <div class="row text-start g-0">
                        <div class="col-lg-6 col-12 px-4 bg-grey">

                            <h4 class="text-center my-3">Joindre une image au produit</h4>

                            <div class="input-group input-group-sm">
                                <input type="file" class="form-control" id="fileToUpload" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                <button class="btn btnBlueDark" type="button" id="inputGroupFileAddon04">Uploader l'image</button>
                            </div>
                            <div class="my-3">
                                <a id="previewLightbox" data-lightbox='roadtrip' href='../../assets/img/admin/noimage.jpg'>
                                    <img id="preview" class="img-fluid border border-secondary" src="../../assets/img/admin/noimage.jpg">
                                </a>
                            </div>

                        </div>
                        <div class="col-lg-6 col-12 px-4 border-grey">
                            <h4 class="text-center my-3">Gérer les images du produit</h4>

                            <div class="row">



                                <div class='col-lg-6 col-12 mb-3'>
                                    <div>
                                        <a data-lightbox='roadtrip' href='../../assets/img/produit21-1.jpg'>
                                            <img class='img-fluid' src='../../assets/img/produit21-1.jpg'>
                                        </a>
                                    </div>
                                    <p class="text-end text-none"><a class="colorBlueDark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-pencil"></i> Editer</a></p>
                                </div>

                                <div class='col-lg-6 col-12 mb-3'>
                                    <div>
                                        <a data-lightbox='roadtrip' href='../../assets/img/produit21-2.jpg'>
                                            <img class='img-fluid' src='../../assets/img/produit21-2.jpg'>
                                        </a>
                                        <p class="text-end text-none"><a class="colorBlueDark" href=""><i class="bi bi-pencil"></i> Editer</a></p>
                                    </div>
                                </div>

                                <div class='col-lg-6 col-12 mb-3'>
                                    <div>
                                        <a data-lightbox='roadtrip' href='../../assets/img/produit21-3.jpg'>
                                            <img class='img-fluid' src='../../assets/img/produit21-3.jpg'>
                                        </a>
                                        <p class="text-end text-none"><a class="colorBlueDark" href=""><i class="bi bi-pencil"></i> Editer</a></p>
                                    </div>
                                </div>

                                <div class='col-lg-6 col-12 mb-3'>
                                    <div>
                                        <a data-lightbox='roadtrip' href='../../assets/img/produit21-4.jpg'>
                                            <img class='img-fluid' src='../../assets/img/produit21-4.jpg'>
                                        </a>
                                        <p class="text-end text-none"><a class="colorBlueDark" href=""><i class="bi bi-pencil"></i> Editer</a></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btnBlue">
        <h5 class="modal-title" id="exampleModalLabel">Editeur d'images</h5>
        <button type="button" class="btnBlueDark" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btnBlueDark">Sauvegarder</button>
        <button type="button" class="btn btn-danger">Supprimer</button>
      </div>
    </div>
  </div>
</div>


                </div>
            </div>
        </div>
    </div>

    <script>
        fileToUpload.addEventListener("change", function() {

            let imageSend = new FileReader();

            imageSend.readAsDataURL(this.files[0]);

            imageSend.onload = () => {
                preview.src = imageSend.result;
                previewLightbox.href = imageSend.result;
            };

        });
    </script>


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
                    idProduct: flexSwitchCheckDefault.dataset.id
                },
                success: function(response) {}
            });

        })
    </script>
    <script src="../../assets/js/lightbox-plus-jquery.js"></script>
    <script src="../../assets/js/appAdmin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>