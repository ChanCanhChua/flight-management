const customSweetAlert = (message='success',type='success',note = '') =>{
    Swal.fire({
        icon: type,
        title: message,
        text: note,
    });
}
window.customSweetAlert = customSweetAlert;
