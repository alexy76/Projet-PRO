<div class="offcanvas offcanvas-end btnBlueDark3 cart" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h3 id="offcanvasRightLabel">Mon panier SportXtrem</h3>
        <button type="button" class="h1 text-white btn btnDarkBlue buthover" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
    </div>
    <div id="productsCart" class="offcanvas-body">
        <div id="displayCart" class="rounded col bg-light text-dark  m-0 px-3" style="max-height: 60vh; overflow: auto;">




        </div>
        <div class="row p-0 m-0 fs-5 mt-2">
            <div class="col-8 text-start p-0">
                Total des articles : <span id="displayNbArticles"></span>
            </div>
            <div class="col-4 text-end p-0">
                <span id="displayPrice"></span>
            </div>

        </div>
        <div class="mt-4">

            <div class="buttons">
                <p class="containerglass2">
                    <a href="/collection/all/1/19/pantalons-de-jogging" class="rounded btnglass2 effect02"><span>Visualiser mon panier <i class="bi bi-chevron-compact-right fw-bold"></i></span></a>
                </p>
            </div>

        </div>
    </div>
</div>
</div>


</main>


<footer class="mt-5" style="min-height: 350px;">

    <?php //if (isset($messageFlash)) : ?>
        <!-- <span id="messageFlash"></span> -->
    <?php //endif; ?>

    <div class="container mb-5">
        <div class="card text-center">

            <div class="card-body p-0">
                <div class="row p-0 m-0">
                    <div class="col-lg-5 p-0 m-0">
                        <img class="img-fluid rounded" src="../../assets/img/newslettershome.webp" alt="Femme enthousiaste au sport d hiver">
                    </div>
                    <div class="col-lg-7 p-0 m-0">

                        <div class="row h-100 justify-content-center align-items-center m-0 px-lg-5 px-2">
                            <div class="mx-auto">

                                <h3 class="mb-4 mt-lg-0 mt-2">Inscrivez-vous à notre Newsletter</h3>

                                <p class="mb-4">Et comme plus de 3600 membres avant vous, profitez dès maintenant de 10% offert sur votre prochaine commande dans notre boutique !</p>

                                <form class="d-lg-block d-none" method="POST" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="NewsLetterMail" placeholder="email@domaine.fr" aria-label="Recipient's username" aria-describedby="button-addon2">

                                        <div class="g-recaptcha" data-sitekey="6Le-4HceAAAAAO_LO-NXQ-WDye4M9aIPQFO5laVH" data-size="invisible"></div>
                                        <button class="btn btnBlueDark4" type="submit" id="button-addon2" name="subscribeNews">Je profite des offres privées</button>
                                    </div>
                                </form>

                                <form class="d-lg-none d-block" method="POST" action="">

                                        <input type="text" class="form-control w-100" name="NewsLetterMail" placeholder="email@domaine.fr" aria-label="Recipient's username" aria-describedby="button-addon2">

                                        <div class="g-recaptcha" data-sitekey="6Le-4HceAAAAAO_LO-NXQ-WDye4M9aIPQFO5laVH" data-size="invisible"></div>
                                        <button class="btn w-100 my-3 btnBlueDark4" type="submit" id="button-addon2" name="subscribeNews">Je profite des offres privées</button>

                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="btnBlueDark3">
        <div class="container">

            <div class="row pt-lg-4 pt-0 pb-lg-1 pb-0 footercolor">
                <div class="col-lg-3 px-2 mt-lg-0 mt-3">
                    <h3 class="h5 mb-3 text-white text-lg-start text-center">CONTACT</h3>
                    <p>Une question ou une suggestion, contactez-nous et vous recevrez une réponse en moins de 24h du lundi au vendredi entre 9 et 17h.</p>
                    <p>Par e-mail : <a class="footerlink" href="contact.php">cliquez ici</a></p>
                    <p>Par téléphone : 07 54 12 54 87</p>
                    <p>Athlectic'Sports appartient à:</p>
                    <p>ATHLECTIC'SPORTS</p>
                    <p>Adresse :</p>
                    <p>200 Bd de Strasbourg<br>76 600 - LE HAVRE</p>
                </div>
                <div class="col-lg-3 px-2 mt-lg-0 mt-3">
                    <h3 class="h5 mb-3 text-white text-lg-start text-center">INFORMATIONS</h3>
                    <p><a class="footerlink" href="../views/blog.php">Blog</a></p>
                    <p><a class="footerlink" href="../views/about.php">A Propos</a></p>
                    <p><a class="footerlink" href="../views/shippingPolicy.php">Politique d'expédition</a></p>
                    <p><a class="footerlink" href="../views/privacyPolicy.php">Politique de confidentialité</a></p>
                    <p><a class="footerlink" href="../views/refundPolicy.php">Politique de Retour et Remboursement</a></p>
                    <p><a class="footerlink" href="../views/legalNotice.php">Mentions légales</a></p>
                    <p><a class="footerlink" href="../views/cgv.php">Conditions Générales de Vente et d'Utilisation</a></p>
                </div>
                <div class="col-lg-3 px-2 mt-lg-0 mt-3">
                    <h3 class="h5 mb-3 text-white text-lg-start text-center">LIENS UTILES</h3>
                    <p><a class="footerlink" href="../views/faq.php">FAQ</a></p>
                    <p><a class="footerlink" href="../views/account.php">Avis clients</a></p>
                    <p><a class="footerlink" href="../views/account.php">Suivi de colis</a></p>
                    <p><a class="footerlink" href="../views/contact.php">Contact</a></p>
                </div>
                <div class="col-lg-3 px-2 mt-lg-0 mt-3">
                    <h3 class="h5 mb-3 text-white text-lg-start text-center">RESTEZ CONNECTÉ.E</h3>
                </div>
            </div>
        </div>
        <hr>
        <div class="container pb-2">
            <div class="row">
                <div class="col-6">
                    <p class="footercolor">© 2022, <a class="footerlink" href="/views/home.php">Athlectic'Sports</a></p>
                </div>
                <div class="col-6 text-end">
                    <img class="me-1" src="../../assets/img/visa.png" alt="badge de paiement visa" height="23px">
                    <img class="me-1" src="../../assets/img/mastercard.png" alt="badge de paiement mastercard" height="23px">
                    <img class="me-1" src="../../assets/img/maestro.png" alt="badge de paiement maestro" height="23px">
                    <img class="me-1" src="../../assets/img/americanxpress.png" alt="badge de paiement american express" height="23px">
                </div>
            </div>

        </div>
    </div>






</footer>

<script>
    document.getElementById('quantityProduct').addEventListener('change', (e) => {

        if (document.getElementById('quantityProduct').value < 1) {
            document.getElementById('quantityProduct').value = 1;
        } else if (document.getElementById('quantityProduct').value > 10) {
            document.getElementById('quantityProduct').value = 10;
        }
    })
</script>

<script>
    if (<?= $flashToast ?? 'false' ?>) {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: '<?= $flashMsg[0] ?>',
            title: '<?= $flashMsg[1] ?>'
        })
    }
</script>
<script src="../../assets/js/lightbox-plus-jquery.js"></script>
<script src="../assets/js/app.js"></script>

</body>

</html>