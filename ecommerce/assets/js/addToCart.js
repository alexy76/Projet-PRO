if (localStorage.getItem('cart') !== null) {

    let quantity = 0;
    let totalCart = 0;

    JSON.parse(localStorage.getItem('cart')).forEach((value, index) => {


        let price = parseFloat(value.price)
        let discount = parseInt(value.discount)
        let total = Number(((price - (price * (discount / 100)).toFixed(2)) * value.quantity).toFixed(2))

        quantity = quantity + parseInt(value.quantity);
        totalCart = totalCart + total




        document.getElementById('displayCart').innerHTML += `
            <div class="py-2 row bg-light w-100 p-0 m-0">
                <div class="col-3">
                    <img class="img-fluid" src="../../assets/img/products/${value.image.image}" alt="${value.image.alt}">
                </div>
                <div class="col-9 position-relative">
                    <a class="text-secondary" href="../../../product/${value.id}/${value.slugTitle}" style="text-decoration: none;">
                        <p  class="mb-2" style="font-size: 0.9rem;">
                            ${value.title}
                        </p>
                    </a>
                    <span data-id="${index}" class="d-inline-block colorlink px-1 rounded-3" style="position: absolute; z-index: 999; top: 0px; right: -12px; border: 1px solid #267691">X</span>

                    <div class="row" style="font-size: 0.9rem;">
                        <div class="col-3 text-start text-dark">
                            <span>Qté : ${value.quantity}</span>
                        </div>
                        <div class="col-3 text-center">
                            <span class="badge btnBlueDark">${value.option}</span>
                        </div>
                        ${value.discount > 0 ? `<div class="col-3 text-center"><span class="badge btnYellow text-dark">-${value.discount}%</span></div>` : '<div class="col-3 text-center"></div>'}
                        <div class="col-3 text-end text-dark">
                            <span>${new Intl.NumberFormat("fr-FR", {style: "currency", currency: "EUR"}).format((value.price  - (Number(value.price * value.discount / 100).toFixed(2))) * value.quantity)}</span>
                        </div>
                </div>
                
            </div>

                </div>
                <hr>`
    })
    document.getElementById('displayNbArticles').innerHTML = quantity;
    if (quantity > 0) {
        document.getElementById('btnCart').innerHTML += `<div class="d-inline-block badgeCart">${quantity}</div>`
    }
    document.getElementById('displayPrice').innerHTML = new Intl.NumberFormat("fr-FR", {
        style: "currency",
        currency: "EUR"
    }).format(totalCart);

} else {
    document.getElementById('displayCart').innerHTML += `
            <div class="">
                <p class="mt-3 text-center">Vous n'avez pas de produit dans votre panier</p>
            </div>
        `
}

//Array.from(document.getElementsByClassName('productsCart')).forEach(element => {

document.getElementById('productsCart').addEventListener('click', (e) => {
    if (e.target.nodeName == 'SPAN') {

        let cart = JSON.parse(localStorage.getItem('cart'));

        cart.forEach((value, index) => {
            if (index == e.target.dataset.id) {

                cart.splice(index, 1)

                localStorage.setItem('cart', JSON.stringify(cart))
                let quantity = 0;
                let totalCart = 0;

                document.getElementById('displayCart').innerHTML = ''

                JSON.parse(localStorage.getItem('cart')).forEach((value, index) => {


                    let price = parseFloat(value.price)
                    let discount = parseInt(value.discount)
                    let total = Number(((price - (price * (discount / 100)).toFixed(2)) * value.quantity).toFixed(2))

                    quantity = quantity + parseInt(value.quantity);
                    totalCart = totalCart + total




                    document.getElementById('displayCart').innerHTML += `
                    <div class="py-2 row bg-light w-100 p-0 m-0">
                    <div class="col-3">
                        <img class="img-fluid" src="../../assets/img/products/${value.image.image}" alt="${value.image.alt}">
                    </div>
                    <div class="col-9 position-relative">
                        <a class="text-secondary" href="../../../product/${value.id}/${value.slugTitle}" style="text-decoration: none;">
                            <p  class="mb-2" style="font-size: 0.9rem;">
                                ${value.title}
                            </p>
                        </a>
                        <span data-id="${index}" class="d-inline-block colorlink px-1 rounded-3" style="position: absolute; z-index: 999; top: 0px; right: -12px; border: 1px solid #267691">X</span>
    
                        <div class="row" style="font-size: 0.9rem;">
                            <div class="col-3 text-start text-dark">
                                <span>Qté : ${value.quantity}</span>
                            </div>
                            <div class="col-3 text-center">
                                <span class="badge btnBlueDark">${value.option}</span>
                            </div>
                            ${value.discount > 0 ? `<div class="col-3 text-center"><span class="badge btnYellow text-dark">-${value.discount}%</span></div>` : '<div class="col-3 text-center"></div>'}
                            <div class="col-3 text-end text-dark">
                                <span>${new Intl.NumberFormat("fr-FR", {style: "currency", currency: "EUR"}).format((value.price  - (Number(value.price * value.discount / 100).toFixed(2))) * value.quantity)}</span>
                            </div>
                    </div>
                    
                </div>
    
                    </div>
                    <hr>`
                })
                document.getElementById('displayNbArticles').innerHTML = quantity;
                if (quantity > 0) {
                    document.getElementById('btnCart').innerHTML += `<div class="d-inline-block badgeCart">${quantity}</div>`
                } else {
                    document.getElementById('btnCart').innerHTML = `<button class="btn btnBlueDark2 nav-link active" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-cart-check-fill"></i> MON PANIER</button>`
                }
                document.getElementById('displayPrice').innerHTML = new Intl.NumberFormat("fr-FR", {
                    style: "currency",
                    currency: "EUR"
                }).format(totalCart);


            }
        })
    }
})






document.getElementById('addToCart').addEventListener('click', (e) => {

    // Permet de récupérer les infos du produit en fonction de l'ID
    // Retourne "false" si l'ID n'éxiste pas
    $.ajax({
        type: 'post',
        url: '../controllers/ctrCartAjax.php',
        data: {
            idProduct: e.target.dataset.id
        },
        success: function (response) {

            if (response == 'false') {

                console.log("id existe pas");

            } else {

                if (parseInt(document.getElementById('quantityProduct').value) >= 1 || parseInt(document.getElementById('quantityProduct').value) <= 10) {

                    if (localStorage.getItem('cart') === null) {
                        localStorage.setItem('cart', 'empty');
                    }

                    responseArray = JSON.parse(response);

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

                    document.getElementById('imgToast').src = `../assets/img/products/${responseArray.images[0].image}`

                    if (localStorage.getItem('cart') === 'empty') {

                        localStorage.setItem('cart', JSON.stringify([cart]))

                        document.getElementById('displayCart').innerHTML = ''

                        let quantity = 0;
                        let totalCart = 0;

                        JSON.parse(localStorage.getItem('cart')).forEach((value, index) => {


                            let price = parseFloat(value.price)
                            let discount = parseInt(value.discount)
                            let total = Number(((price - (price * (discount / 100)).toFixed(2)) * value.quantity).toFixed(2))

                            quantity = quantity + parseInt(value.quantity);
                            totalCart = totalCart + total




                            document.getElementById('displayCart').innerHTML += `
                            <div class="py-2 row bg-light w-100 p-0 m-0">
                    <div class="col-3">
                        <img class="img-fluid" src="../../assets/img/products/${value.image.image}" alt="${value.image.alt}">
                    </div>
                    <div class="col-9 position-relative">
                        <a class="text-secondary" href="../../../product/${value.id}/${value.slugTitle}" style="text-decoration: none;">
                            <p  class="mb-2" style="font-size: 0.9rem;">
                                ${value.title}
                            </p>
                        </a>
                        <span data-id="${index}" class="d-inline-block colorlink px-1 rounded-3" style="position: absolute; z-index: 999; top: 0px; right: -12px; border: 1px solid #267691">X</span>
    
                        <div class="row" style="font-size: 0.9rem;">
                            <div class="col-3 text-start text-dark">
                                <span>Qté : ${value.quantity}</span>
                            </div>
                            <div class="col-3 text-center">
                                <span class="badge btnBlueDark">${value.option}</span>
                            </div>
                            ${value.discount > 0 ? `<div class="col-3 text-center"><span class="badge btnYellow text-dark">-${value.discount}%</span></div>` : '<div class="col-3 text-center"></div>'}
                            <div class="col-3 text-end text-dark">
                                <span>${new Intl.NumberFormat("fr-FR", {style: "currency", currency: "EUR"}).format((value.price  - (Number(value.price * value.discount / 100).toFixed(2))) * value.quantity)}</span>
                            </div>
                    </div>
                    
                </div>
    
                    </div>
                    <hr>`
                        })
                        document.getElementById('displayNbArticles').innerHTML = quantity;
                        if (quantity > 0) {
                            document.getElementById('btnCart').innerHTML += `<div class="d-inline-block badgeCart">${quantity}</div>`
                        } else {
                            document.getElementById('btnCart').innerHTML = `<button class="btn btnBlueDark2 nav-link active" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-cart-check-fill"></i> MON PANIER</button>`
                        }
                        document.getElementById('displayPrice').innerHTML = new Intl.NumberFormat("fr-FR", {
                            style: "currency",
                            currency: "EUR"
                        }).format(totalCart);
                        
                        var toast = new bootstrap.Toast(document.getElementById('liveToast'))
                        toast.show()

                    } else {

                        let doublon = false

                        arrayCart = JSON.parse(localStorage.getItem('cart'))

                        arrayCart.forEach(elt => {

                            if (elt.id == responseArray.id && document.getElementById('optionProduct').value == elt.option) {

                                doublon = true

                                elt.quantity = parseInt(elt.quantity) + parseInt(document.getElementById('quantityProduct').value)
                                localStorage.setItem('cart', JSON.stringify(arrayCart))

                                document.getElementById('displayCart').innerHTML = ''

                                let quantity = 0;
                                let totalCart = 0;

                                JSON.parse(localStorage.getItem('cart')).forEach((value, index) => {


                                    let price = parseFloat(value.price)
                                    let discount = parseInt(value.discount)
                                    let total = Number(((price - (price * (discount / 100)).toFixed(2)) * value.quantity).toFixed(2))

                                    quantity = quantity + parseInt(value.quantity);
                                    totalCart = totalCart + total




                                    document.getElementById('displayCart').innerHTML += `
                                    <div class="py-2 row bg-light w-100 p-0 m-0">
                    <div class="col-3">
                        <img class="img-fluid" src="../../assets/img/products/${value.image.image}" alt="${value.image.alt}">
                    </div>
                    <div class="col-9 position-relative">
                        <a class="text-secondary" href="../../../product/${value.id}/${value.slugTitle}" style="text-decoration: none;">
                            <p  class="mb-2" style="font-size: 0.9rem;">
                                ${value.title}
                            </p>
                        </a>
                        <span data-id="${index}" class="d-inline-block colorlink px-1 rounded-3" style="position: absolute; z-index: 999; top: 0px; right: -12px; border: 1px solid #267691">X</span>
    
                        <div class="row" style="font-size: 0.9rem;">
                            <div class="col-3 text-start text-dark">
                                <span>Qté : ${value.quantity}</span>
                            </div>
                            <div class="col-3 text-center">
                                <span class="badge btnBlueDark">${value.option}</span>
                            </div>
                            ${value.discount > 0 ? `<div class="col-3 text-center"><span class="badge btnYellow text-dark">-${value.discount}%</span></div>` : '<div class="col-3 text-center"></div>'}
                            <div class="col-3 text-end text-dark">
                                <span>${new Intl.NumberFormat("fr-FR", {style: "currency", currency: "EUR"}).format((value.price  - (Number(value.price * value.discount / 100).toFixed(2))) * value.quantity)}</span>
                            </div>
                    </div>
                    
                </div>
    
                    </div>
                    <hr>`
                                })
                                document.getElementById('displayNbArticles').innerHTML = quantity;
                                if (quantity > 0) {
                                    document.getElementById('btnCart').innerHTML += `<div class="d-inline-block badgeCart">${quantity}</div>`
                                } else {
                                    document.getElementById('btnCart').innerHTML = `<button class="btn btnBlueDark2 nav-link active" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-cart-check-fill"></i> MON PANIER</button>`
                                }
                                document.getElementById('displayPrice').innerHTML = new Intl.NumberFormat("fr-FR", {
                                    style: "currency",
                                    currency: "EUR"
                                }).format(totalCart);

                                var toast = new bootstrap.Toast(document.getElementById('liveToast'))
                        toast.show()

                            }
                        })

                        if (!doublon) {

                            arrayCart.push(cart);
                            localStorage.setItem('cart', JSON.stringify(arrayCart))

                            document.getElementById('displayCart').innerHTML = ''

                            let quantity = 0;
                            let totalCart = 0;

                            JSON.parse(localStorage.getItem('cart')).forEach((value, index) => {


                                let price = parseFloat(value.price)
                                let discount = parseInt(value.discount)
                                let total = Number(((price - (price * (discount / 100)).toFixed(2)) * value.quantity).toFixed(2))

                                quantity = quantity + parseInt(value.quantity);
                                totalCart = totalCart + total




                                document.getElementById('displayCart').innerHTML += `
                                <div class="py-2 row bg-light w-100 p-0 m-0">
                    <div class="col-3">
                        <img class="img-fluid" src="../../assets/img/products/${value.image.image}" alt="${value.image.alt}">
                    </div>
                    <div class="col-9 position-relative">
                        <a class="text-secondary" href="../../../product/${value.id}/${value.slugTitle}" style="text-decoration: none;">
                            <p  class="mb-2" style="font-size: 0.9rem;">
                                ${value.title}
                            </p>
                        </a>
                        <span data-id="${index}" class="d-inline-block colorlink px-1 rounded-3" style="position: absolute; z-index: 999; top: 0px; right: -12px; border: 1px solid #267691">X</span>
    
                        <div class="row" style="font-size: 0.9rem;">
                            <div class="col-3 text-start text-dark">
                                <span>Qté : ${value.quantity}</span>
                            </div>
                            <div class="col-3 text-center">
                                <span class="badge btnBlueDark">${value.option}</span>
                            </div>
                            ${value.discount > 0 ? `<div class="col-3 text-center"><span class="badge btnYellow text-dark">-${value.discount}%</span></div>` : '<div class="col-3 text-center"></div>'}
                            <div class="col-3 text-end text-dark">
                                <span>${new Intl.NumberFormat("fr-FR", {style: "currency", currency: "EUR"}).format((value.price  - (Number(value.price * value.discount / 100).toFixed(2))) * value.quantity)}</span>
                            </div>
                    </div>
                    
                </div>
    
                    </div>
                    <hr>`
                            })
                            document.getElementById('displayNbArticles').innerHTML = quantity;
                            if (quantity > 0) {
                                document.getElementById('btnCart').innerHTML += `<div class="d-inline-block badgeCart">${quantity}</div>`
                            } else {
                                document.getElementById('btnCart').innerHTML = `<button class="btn btnBlueDark2 nav-link active" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-cart-check-fill"></i> MON PANIER</button>`
                            }
                            document.getElementById('displayPrice').innerHTML = new Intl.NumberFormat("fr-FR", {
                                style: "currency",
                                currency: "EUR"
                            }).format(totalCart);

                            
                            var toast = new bootstrap.Toast(document.getElementById('liveToast'))
                        toast.show()
                        }
                    }
                } else {
                    console.log("la quantité n'est pas un entier positif")
                }
            }
        }
    });

})