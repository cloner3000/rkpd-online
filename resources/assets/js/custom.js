$(document).ready(function () {
    $('.disable-edit').click(function (e) {
        e.preventDefault();
    });

    $('.hasil-kegiatan-remove').on('click', function () {
        $(this).closest('.row').remove();
    });
});