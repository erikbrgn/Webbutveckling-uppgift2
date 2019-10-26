var form = document.getElementById('form');
if (form) {
    var action = document.getElementById('action');
    action.addEventListener('change', function() {
        var value = this.options[this.selectedIndex].value;
        console.log(value);
        if (value === '0') {
            form.querySelectorAll('.form-field.input').forEach(function(element) {
                if (element.classList.contains('visually-hidden')) {
                    console.log('bajs');
                }
                element.classList.remove('visually-hidden');
        });
        } else if (value === '1') {
            // DISPLAY FORM
        } else if (value === '2') {
            // Delete user
            var modal = $('#modal').modal('toggle');
            var btn_confirm = document.getElementById('btn_confirm');
            btn_confirm.addEventListener('click', function() {
                form.submit();
                modal.modal('dispose');
            });
        }
    });
}