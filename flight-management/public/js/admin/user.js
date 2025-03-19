
function addUser(){
   
    $.ajax({
        url: '/admin/register',
        type:'POST',
        data: $('#formRegisterUser').serialize(),
        success: function(data) {

            $('#modalRegister').modal('hide');
            customSweetAlert(data.message,'success');
 
        },
        error: function(data) {

            $(".overlay").fadeOut(300);

            let message = '';

            $.each(data.responseJSON.errors, function(key, val) {
                message += `${val}<br>`
            })

            customSweetAlert(message,'error');

        },
    }).done(function(response) {

        $(".overlay").fadeOut(300);

    });
}


document.addEventListener("DOMContentLoaded", () => {

    document.querySelector('#formRegisterUserSubmit').addEventListener('click', function (e) {
        e.preventDefault();
        addUser();
    })
})
