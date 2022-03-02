const inputDelete = Array.from(document.getElementsByClassName('inputDelete'));
const inputGenerate = document.getElementById('inputGenerate');
const allCheckbox = document.getElementById('allCheckbox');
const formInputsDelete = document.getElementById('formInputsDelete');
const inputGenerateDiscount = document.getElementById('inputGenerateDiscount');
const formInputsApplyDiscount = document.getElementById('formInputsApplyDiscount');
const metaTitle = document.getElementById('metaTitle');
const metaDescription = document.getElementById('metaDescription');
const nbCharsTitle = document.getElementById('nbCharsTitle');
const nbCharsDescription = document.getElementById('nbCharsDescription');
const displayTitleGoogle = document.getElementById('displayTitleGoogle');
const displayDescriptionGoogle = document.getElementById('displayDescriptionGoogle');

window.addEventListener('DOMContentLoaded', () => {

    nbCharsTitle.innerText = metaTitle.value.length;
    nbCharsDescription.innerText = metaDescription.value.length;



    if (metaTitle.value.length == 0) {
        displayTitleGoogle.innerText = "Bague Tête de Mort | Crâne Faction";
    }

    if (metaDescription.value.length == 0) {
        displayDescriptionGoogle.innerText = "Nos Bagues Têtes de Mort forgées dans les entrailles de l'enfer vont te faire craquer. Biker dissident, punk, métalleux énervé ou gothique : bienvenue !";
    }
})

metaTitle.addEventListener('keyup', () => {

    let lenghtText = metaTitle.value.length;

    displayTitleGoogle.innerText = metaTitle.value

    if (lenghtText == 0) {
        displayTitleGoogle.innerText = 'Bague Tête de Mort | Crâne Faction';
        nbCharsTitle.innerText = '0';
    } else
        nbCharsTitle.innerText = lenghtText;
});

metaDescription.addEventListener('keyup', () => {

    let lenghtText = metaDescription.value.length;

    displayDescriptionGoogle.innerText = metaDescription.value;

    if (lenghtText == 0) {
        displayDescriptionGoogle.innerText = 'Nos Bagues Têtes de Mort forgées dans les entrailles de l\'enfer vont te faire craquer. Biker dissident, punk, métalleux énervé ou gothique : bienvenue !';
        nbCharsTitle.innerText = '0';
    } else
        nbCharsDescription.innerText = lenghtText;
});


if (inputDelete.length > 0) {

    allCheckbox.addEventListener('change', () => {
        if (allCheckbox.checked) {
            inputGenerate.innerHTML = '';
            inputGenerateDiscount.innerHTML = '';
            Array.from(document.getElementsByClassName('inputDelete')).forEach(elt => {
                elt.checked = true;
                inputGenerate.innerHTML += `<input type="hidden" name="deleteUsers[]" value="${elt.value}">`;
                inputGenerateDiscount.innerHTML += `<input type="hidden" name="applyDiscount[]" value="${elt.value}">`;
            });
            formInputsDelete.classList.replace('d-none', 'd-block');
            formInputsApplyDiscount.classList.replace('d-none', 'd-block');
        } else {
            inputGenerate.innerHTML = '';
            inputGenerateDiscount.innerHTML = '';
            Array.from(document.getElementsByClassName('inputDelete')).forEach(elt => {
                elt.checked = false;
            });
            formInputsDelete.classList.replace('d-block', 'd-none');
            formInputsApplyDiscount.classList.replace('d-block', 'd-none');
        }
    })

    inputDelete.forEach(element => {

        element.addEventListener('change', () => {

            inputGenerate.innerHTML = '';
            inputGenerateDiscount.innerHTML = '';
            let count = 0;
            let countInputs = Array.from(document.getElementsByClassName('inputDelete')).length;

            Array.from(document.getElementsByClassName('inputDelete')).forEach(elt => {

                if (elt.checked) {
                    inputGenerate.innerHTML += `<input type="hidden" name="deleteUsers[]" value="${elt.value}">`;
                    inputGenerateDiscount.innerHTML += `<input type="hidden" name="applyDiscount[]" value="${elt.value}">`;
                } else
                    count++;
            });

            if (count == countInputs) {
                formInputsDelete.classList.replace('d-block', 'd-none');
                formInputsApplyDiscount.classList.replace('d-block', 'd-none');
                allCheckbox.checked = false;
            } else if (count < countInputs && count != 0) {
                formInputsDelete.classList.replace('d-none', 'd-block');
                formInputsApplyDiscount.classList.replace('d-none', 'd-block');
                allCheckbox.checked = false;
            } else {
                formInputsDelete.classList.replace('d-none', 'd-block');
                formInputsApplyDiscount.classList.replace('d-none', 'd-block');
                allCheckbox.checked = true;
            }
        });
    });
}