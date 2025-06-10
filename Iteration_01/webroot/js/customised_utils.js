
$(document).ready(function (){
    console.log("Loaded")
    form_textarea = document.getElementById('form-textarea');
    field_current_count = document.getElementById('current_count');


    if(form_textarea && field_current_count){
        form_textarea.addEventListener('keydown',function (){
            console.log(this.value.length)
            field_current_count.textContent  = this.value.length;
        })

    }

    togglePasswordIcon = document.getElementById('togglePasswordIcon');

    if(togglePasswordIcon){
        togglePasswordIcon.addEventListener('click',function (){


            console.log("clcicked")
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }

        })
    }


})
