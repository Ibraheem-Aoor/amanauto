$(document).ready(function () {

    $(document).on('submit', 'form[name="tender-form"]', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    $('#myTable').DataTable().ajax.reload();
                } else {
                    toastr.error(response.message);
                }
                if (response.reset_form) {
                    $('button[type="reset"]').click();
                }
            }, error: function (response) {
                if (response.status == 422) {
                    $.each(response.responseJSON.errors, function (key, errorsArray) {
                        $.each(errorsArray, function (item, error) {
                            toastr.error(error);
                        });
                    });
                } else {
                    toastr.error(response.responseJSON.message);
                }
            }
        });
    });
    // if we the talbe_data_url exists this means we are at a table page.
    if (typeof table_data_url !== 'undefined') {
        renderDataTable();
    }

    $('#create-edit-modal').on('show.bs.modal' , function(e){
        var btn = e.relatedTarget;
        var isUpdatedModal = btn.getAttribute('data-is-updated');
        if(isUpdatedModal)
        {
            $(this).find('form').attr('action' , btn.getAttribute('data-form-action'));
            $(this).find('form').attr('method' , 'PUT');
            var transaction = JSON.parse(btn.getAttribute('data-transaction'));
            $(this).find('#title').val(transaction.title);
            $(this).find('#amount').val(transaction.amount);
            $(this).find('#project_id').val(transaction.project_id);
            $(this).find('#payment_status').val(transaction.payment_status);
        }else{
            $('button[type="reset"]').click();
            $(this).find('form').attr('action' , btn.getAttribute('data-form-action'));
            $(this).find('form').attr('method' , 'POST');
        }
    });
});

/**
    * render Datatable
    */
function renderDataTable() {
    $('#myTable').DataTable({
        language: language,
        order: [[ 6 , 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: table_data_url,
        columns: getTableColumns(),
    });
}

function getTableColumns() {
    return [{
        data: 'title',
        name: 'title',
        searchable: true,
        orderable: true,
    }, {
        data: 'project_no',
        name: 'project.no',
        searchable: true,
        orderable: true,
    }, {
        data: 'project_name',
        name: 'project.name',
        searchable: true,
        orderable: true,
    },
    {
        data: 'amount',
        name: 'amount',
        searchable: true,
        orderable: true,
    },
    {
        data: 'payment_status',
        name: 'payment_status',
        searchable: true,
        orderable: true,
    },
    {
        data: 'actions',
        name: 'actions',
        searchable: false,
        orderable: false,
    },
    {
        data: 'created_at',
        name: 'created_at',
        searchable: false,
        orderable: true,
        visible:false,
    },
    ];
}

