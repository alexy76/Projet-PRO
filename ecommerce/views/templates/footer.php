    <?php if (isset($messageFlash)) : ?>
        <span id="messageFlash"></span>
    <?php endif; ?>


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
    <script src="../assets/js/app.js"></script>

    </body>

    </html>