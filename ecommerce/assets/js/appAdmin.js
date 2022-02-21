const inputDelete = Array.from(document.getElementsByClassName('inputDelete'));
const inputGenerate = document.getElementById('inputGenerate');
const allCheckbox = document.getElementById('allCheckbox');
const formInputsDelete = document.getElementById('formInputsDelete');



if (inputDelete.length > 0) {

    allCheckbox.addEventListener('change', () => {
        if (allCheckbox.checked) {
            inputGenerate.innerHTML = '';
            Array.from(document.getElementsByClassName('inputDelete')).forEach(elt => {
                elt.checked = true;
                inputGenerate.innerHTML += `<input type="hidden" name="deleteUsers[]" value="${elt.value}">`;
            });
            formInputsDelete.classList.replace('d-none', 'd-block');
        } else {
            inputGenerate.innerHTML = '';
            Array.from(document.getElementsByClassName('inputDelete')).forEach(elt => {
                elt.checked = false;
            });
            formInputsDelete.classList.replace('d-block', 'd-none');
        }
    })

    inputDelete.forEach(element => {

        element.addEventListener('change', () => {

            inputGenerate.innerHTML = '';
            let count = 0;
            let countInputs = Array.from(document.getElementsByClassName('inputDelete')).length;

            Array.from(document.getElementsByClassName('inputDelete')).forEach(elt => {

                    if (elt.checked)
                        inputGenerate.innerHTML += `<input type="hidden" name="deleteUsers[]" value="${elt.value}">`;
                    else
                        count++;
            });

            if(count == countInputs){
                formInputsDelete.classList.replace('d-block', 'd-none');
                allCheckbox.checked = false;
            }else if(count < countInputs && count != 0){
                formInputsDelete.classList.replace('d-none', 'd-block');
                allCheckbox.checked = false;
            }else{
                formInputsDelete.classList.replace('d-none', 'd-block');
                allCheckbox.checked = true;
            }
        });
    });
}