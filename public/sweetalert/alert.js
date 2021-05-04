function deleteRow(id) {
    swal({
            title: "Apakah Anda Yakin?",
            text: "Data Yang Sudah Dihapus Tidak Dapat Dikembalikan",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        })
        .then((result) => {
            if (result.value) {
                $('#data-' + id).submit();
            }
        });
}