
/**
    * render Datatable
    */
function renderDataTable() {
    $('#myTable').DataTable({
        language: language,
        order: [[11, 'desc']],
        processing: true,
        serverSide: true,
        ajax: table_data_url,
        columns: getTableColumns(),
    });
}

function getTableColumns() {
    return [
        {
            data: 'checkbox',
            name: 'checkbox',
            searchable: false,
            orderable: false,
        }, {
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
            data: 'area',
            name: 'area.name',
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
            data: 'start_date',
            name: 'start_date',
            searchable: true,
            orderable: true,
        },
        {
            data: 'end_date',
            name: 'end_date',
            searchable: true,
            orderable: true,
        },
        {
            data: 'phase',
            name: 'phase',
            searchable: false,
            orderable: false,
        },
        {
            data: 'action',
            name: 'action.name',
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


    ];
}


$(document).ready(function () {
    renderDataTable();
    $(document).on('click', '#filter-btn', function () {
        reloadDataTableWithFilters();
    });
    // Function to reload the DataTable with the updated AJAX URL
    function reloadDataTableWithFilters() {
        var filter = getFilterValues();
        var url = table_data_url + '?' + $.param(filter);
        $('#myTable').DataTable().ajax.url(url).load();
    }
    // Function to get the filter values from the form
    function getFilterValues() {
        var filter = {
            type: $("select[name='filter[type]']").val(),
            area: $("select[name='filter[area]']").val(),
            sector: $("select[name='filter[sector]']").val(),
            action: $("select[name='filter[action]']").val(),
            start_date: $("input[name='filter[start_date]']").val(),
            end_date: $("input[name='filter[end_date]']").val(),
        };
        return filter;
    }
});
