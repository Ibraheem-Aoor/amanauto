$(document).ready(function () {
    $(document).on('submit', 'form[name="create-project"]', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('data-action-url'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
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
                } else if (response.responseJSON.message) {
                    toastr.error(response.responseJSON.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
    // if we the talbe_data_url exists this means we are at a table page.
    if (typeof table_data_url !== 'undefined') {
        renderDataTable();
    }
});

/**
    * render Datatable
    */
function renderDataTable() {
    $('#myTable').DataTable({
        language: language,
        order: [[6, 'desc']],
        processing: true,
        serverSide: true,
        ajax: table_data_url,
        columns: getTableColumns(),
    });
}

function getTableColumns() {
    return [{
        data: 'company_name',
        name: 'company_name',
        searchable: true,
        orderable: true,
    },
    {
        data: 'license_number',
        name: 'license_number',
    },
    {
        data: 'owner',
        name: 'owner',
        searchable: true,
        orderable: true,
    },
    {
        data: 'type',
        name: 'type.name',
        searchable: true,
        orderable: true,
    },
    {
        data: 'sector',
        name: 'sector.name',
        searchable: true,
        orderable: true,
    },
    {
        data: 'created_at',
        name: 'created_at',
        searchable: false,
        orderable: true,
        visible: true,
    },
    {
        data: 'actions',
        name: 'actions',
        searchable: false,
        orderable: false,
    },



    ];
}


/**
 * Project Info modal
 */

$('#show-info').on('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    var project = JSON.parse(btn.getAttribute('data-project'));
    var delegatorPdfRoute = btn.getAttribute('data-delegator-transaction-pdf');
    var applicationFeePdfRoute = btn.getAttribute('data-application-fee-pdf');
    var tenderPdf = btn.getAttribute('data-tender-pdf');
    $(this).find('.modal-title').text(project.name);
    $(this).find('#modal-project-no').text(project.no);
    $(this).find('#modal-project-land-no').text(project.land_no);
    $(this).find('#modal-project-land-area').text(project.land_area);
    $(this).find('#modal-project-budget').text(project.budget);
    $(this).find('#modal-project-client').text(project.client.name);
    $(this).find('#modal-project-consultant').text(project.consultant.name);
    $(this).find('#modal-project-consultant-budget').text(project.consultant_total_budget);
    $(this).find('#modal-project-delegator').text(project.delegator.name);
    $(this).find('#modal-project-delegator-budget').text(project.delegator_total_budget);
    $(this).find('#modal-project-contractor').text(project.contractor.name);
    $(this).find('#delegator-transactionp-route').attr('href', delegatorPdfRoute);
    $(this).find('#application-fees-route').attr('href', applicationFeePdfRoute);
    $(this).find('#tender-pdf-route').attr('href', tenderPdf);

});
