<div class="offcanvas offcanvas-end btnBlueDark3 cart" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" >
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
                    <a href="" class="rounded btnglass2 effect02"><span>Visualiser mon panier <i class="bi bi-chevron-compact-right fw-bold"></i></span></a>
                </p>
            </div>

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