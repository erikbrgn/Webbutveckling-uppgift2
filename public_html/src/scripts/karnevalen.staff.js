var form = document.getElementById('form');
var submit = document.getElementById('view_submit');
if (form) {
    var action = document.getElementById('action');
    action.addEventListener('change', function () {
        var value = this.options[this.selectedIndex].value;
        console.log(value);
        if (value === '0') {
            form.querySelectorAll('.form-field.input, #form>.d-flex, .form-field.select, .form-field.textarea.textarea_answer').forEach(function (element) {
                if (element.classList.contains('visually-hidden')) {
                    element.classList.remove('visually-hidden');
                }
                var input = element.querySelector('input');
                // input.value = '';
                // input.focus();
                // input.blur();
            });
            submit.value = 'Lägg till';
        } else if (value === '1') {
            form.querySelectorAll('.form-field.input, #form>.d-flex, .form-field.select, .form-field.textarea').forEach(function (element) {
                if (element.classList.contains('visually-hidden')) {
                    element.classList.remove('visually-hidden');
                }
            });
            submit.value = 'Uppdatera';
        } else if (value === '2') {
            // Delete user
            var modal = $('#modal').modal('toggle');
            var btn_confirm = document.getElementById('btn_confirm');
            btn_confirm.addEventListener('click', function () {
                form.submit();
                modal.modal('dispose');
            });
        } else {
            form.querySelectorAll('.form-field.input, #form>.d-flex, .form-field.select').forEach(function (element) {
                if (element.classList.contains('visually-hidden')) {
                    element.classList.remove('visually-hidden');
                } else {
                    element.classList.add('visually-hidden');
                }
                
            });
        }
    });
}

function toggleForm() {
    var form = document.getElementById('add_user_form');
    form.classList.toggle('visually-hidden');
}

function check(input, password_input) {
    if (input.value != document.getElementById(password_input).value) {
        input.setCustomValidity('Lösenorden måste matcha.');
    } else {
        // input is valid -- reset the error message
        input.setCustomValidity('');
    }
}