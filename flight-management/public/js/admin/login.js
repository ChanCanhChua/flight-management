function login() {
    $.ajax({
        url: '/admin/user/login',
        type: 'POST',
        data: $('#formLoginUser').serialize(),
        success: function(data) {

            $(".overlay").fadeOut(300);
            // Close the modal
            $('#modalLogin').modal('hide');

            
            const email = data.user.email; 
            const name = data.user.name || 'User'; 
            const message = `Chào mừng ${name} (${email})! Bạn đã đăng nhập thành công.`;

           
            customSweetAlert(message, 'success');
        },
        error: function(data) {

            $(".overlay").fadeOut(300);

            let message = '';

            if (data.responseJSON && data.responseJSON.errors) {
                // Handle validation errors
                $.each(data.responseJSON.errors, function(key, val) {
                    message += `${val}<br>`;
                });
            } else if (data.responseJSON && data.responseJSON.message) {
                // Handle general errors
                message = data.responseJSON.message;
            } else {
                // Default error message
                message = 'Đã xảy ra lỗi không xác định!';
            }

            // Show the error alert
            customSweetAlert(message, 'error');
        },
    });
}


document.addEventListener("DOMContentLoaded", () => {

    document.querySelector('#formLoginUserSubmit').addEventListener('click', function (e) {
        e.preventDefault();
        login();
    })
})