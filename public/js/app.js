let urlDefault = 'http://127.0.0.1:8000/';

$(document).ready(function () {
    $('#btnCancel').click(function (e) {
        e.preventDefault();
        //xóa tất cả sau dấu ?
        window.location.href = urlDefault + 'products';
    })
});
$(document).ready(function () {
    $('#btnCancelCustomer').click(function (e) {
        e.preventDefault();
        //xóa tất cả sau dấu ?
        window.location.href = urlDefault + 'customers';
    })
});
$(document).ready(function () {
    $('#btnCancelUser').click(function (e) {
        e.preventDefault();
        //xóa tất cả sau dấu ?
        window.location.href = urlDefault + 'users';
    })
});



// datatable
$(document).ready(function () {
    $('#example').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
        }
    });
});

$(document).ready(function () {
    $('#btnDeleteFile').click(function () {
        $("#inputGroupFile03").val(null);
    })
});

