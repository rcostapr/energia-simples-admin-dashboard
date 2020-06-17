
$(document).ready(function () {
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    $(".btn-success").click(function () {
        // Display a warning toast
        toastr.success('Energia Simples. Success !!!', 'User Updated', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
    });
});