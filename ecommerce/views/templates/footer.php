<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Mon panier</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="displayCart" class="col">


        </div>
    </div>
</div>
</div>


</main>


<footer>
    <?php if (isset($messageFlash)) : ?>
        <span id="messageFlash"></span>
    <?php endif; ?>



</footer>

<script>
    document.getElementById('quantityProduct').addEventListener('change', (e) => {

        if (document.getElementById('quantityProduct').value < 1) {
            document.getElementById('quantityProduct').value = 1;
        } else if (document.getElementById('quantityProduct').value > 10) {
            document.getElementById('quantityProduct').value = 10;
        }
    })



    document.getElementById('addToCart').addEventListener('click', (e) => {

        //console.log(e.target.dataset);
        //console.log(document.getElementById('quantityProduct').value)
        //console.log(document.getElementById('optionProduct').value)

        // Permet de récupérer les infos du produit en fonction de l'ID
        // Retourne "false" si l'ID n'éxiste pas
        $.ajax({
            type: 'post',
            url: '../controllers/ctrCartAjax.php',
            data: {
                idProduct: e.target.dataset.id
            },
            success: function(response) {
                //$('#res').html(response);
                //console.log(response);
                if (response == 'false') {

                    console.log("id existe pas");

                } else {

                    if (parseInt(document.getElementById('quantityProduct').value) >= 1 || parseInt(document.getElementById('quantityProduct').value) <= 10) {

                        if (localStorage.getItem('cart') === null) {
                            localStorage.setItem('cart', 'empty');
                        }

                        responseArray = JSON.parse(response);

                        console.log(responseArray)

                        let cart = {
                            id: parseInt(responseArray.id),
                            image: responseArray.images[0],
                            title: responseArray.title,
                            slugTitle: responseArray.slug,
                            price: parseFloat(responseArray.price).toFixed(2),
                            discount: parseFloat(responseArray.discount),
                            option: document.getElementById('optionProduct').value,
                            quantity: parseInt(document.getElementById('quantityProduct').value)
                        }

                        if (localStorage.getItem('cart') === 'empty') {

                            localStorage.setItem('cart', JSON.stringify([cart]))
                        } else {

                            let doublon = false

                            arrayCart = JSON.parse(localStorage.getItem('cart'))

                            arrayCart.forEach(elt => {

                                if (elt.id == responseArray.id && document.getElementById('optionProduct').value == elt.option) {

                                    doublon = true

                                    elt.quantity = parseInt(elt.quantity) + parseInt(document.getElementById('quantityProduct').value)
                                    localStorage.setItem('cart', JSON.stringify(arrayCart))
                                    //console.log(JSON.parse(localStorage.getItem('cart')))
                                }
                            })

                            console.log(doublon)
                            if (!doublon) {

                                arrayCart.push(cart);
                                localStorage.setItem('cart', JSON.stringify(arrayCart))
                                //console.log(JSON.parse(localStorage.getItem('cart')))
                                document.getElementById('displayCart').innerHTML = ''

                                JSON.parse(localStorage.getItem('cart')).forEach((value, index) => {
                                    console.log(value)
                                    document.getElementById('displayCart').innerHTML += `
                                    <div class="row mb-4">
                                        <div class="col-3">
                                            <img class="img-fluid" src="../../assets/img/products/${value.image.image}" alt="${value.image.alt}">
                                        </div>
                                        <div class="col-9">
                                            <a class="text-secondary" href="../../../product/${value.id}/${value.slugTitle}" style="text-decoration: none;">
                                                <p class="mb-2" style="font-size: 0.9rem;">${value.title}</p>
                                            </a>
                                            <div class="row" style="font-size: 0.9rem;">
                                                <div class="col-6 text-start">
                                                    <span>Qté : ${value.quantity}</span>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span>${new Intl.NumberFormat("fr-FR", {style: "currency", currency: "EUR"}).format((value.price  - (value.price * value.discount / 100)) * value.quantity)}</span>
                                                </div>
                                            </div>
                                        </div>

                                        </div>`
                                    console.log(index)
                                })
                            }


                        }
                    } else {
                        console.log("la quantité n'est pas un entier positif")
                    }



                }
            }
        });

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