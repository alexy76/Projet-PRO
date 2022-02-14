const nbChars = document.getElementById('nbChars');
const textContact = document.getElementById('textContact');

window.addEventListener('DOMContentLoaded', function () {

    if (messageFlash) {

        Swal.fire({
            position: 'middle',
            icon: 'success',
            title: 'Votre inscription a bien été validée !\n\n<span class="text-success">Pensez à consulter vos mails afin de confirmer votre adresse</span>',
            showConfirmButton: false,
            timer: 3000
        });
    }
});



textContact.addEventListener('keypress', (e) => {
    let lenghtText = textContact.value.length;

    if(lenghtText > 500)
        e.preventDefault();
    else
        nbChars.innerText = lenghtText;
});


