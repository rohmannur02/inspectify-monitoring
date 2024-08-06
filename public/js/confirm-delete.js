// public/js/confirm-delete.js
$(document).ready(function() {
    $('.confirm-delete').on('click', function(e) {
        e.preventDefault(); // Prevent form submission
        var form = $(this).closest('form');

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda Tidak Akan Bisa Melihat Data ini Lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
});
