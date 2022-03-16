<div class="offcanvas offcanvas-end btnBlueDark3" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h3 id="offcanvasRightLabel">Mon panier SportXtrem</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="displayCart" class="col px-2">


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