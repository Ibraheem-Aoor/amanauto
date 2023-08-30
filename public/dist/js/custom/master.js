var preloader = document.getElementById('preloader');
$(document).ready(function () {
    preloader.style.display = 'none';

    $('#delete-modal').on('show.bs.modal', function (e) {
        var btn = e.relatedTarget;
        var deleteUrl = btn.getAttribute('data-delete-url');
        var message = btn.getAttribute('data-message');
        var name = btn.getAttribute('data-name');
        var modalForm = $(this).find('form[name="confirm-delete-form"]');
        modalForm.attr('action', deleteUrl);
        modalForm.attr('method', 'DELETE');
        $(this).find('.modal-body p').text(message + "\t" + name);
    });
    //Handle delete confirmation form
    $(document).on('submit', 'form[name="confirm-delete-form"]', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: {},
            success: function (response) {
                if (response.is_deleted) {
                    toastr.success(response.message);
                    $('#row-' + response.row).parent().parent().parent().remove();
                    $('#delete-modal').modal('hide');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (response) {
                toastr.error(response.message);
            }
        });
    });
});

/* ############# GENERAL FORM SUBMIT ################ */

$(document).on('submit', '.custom-form', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    preloader.style.display = 'block';
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        processData: false,
        contentType: false,
        data: formData,
        enctype: "multipart/form-data",
        success: function (response) {
            if (response.status) {
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
            if (response.reset_form) {
                $(this).trigger('reset');
            }
            if (response.modal_to_hide) {
                $(response.modal_to_hide).modal('hide');
            }
            if (response.reload) {
                setTimeout(function () {
                    location.reload();
                }, 1000); // wait for 1 second
            }
            if (response.reload_table) {
                $('#myTable').DataTable().ajax.reload();
            }
            if (response.redirect) {
                setTimeout(function () {
                    location.href = response.redirect;
                }, 1000); // wait for 1 second
            }
            preloader.style.display = 'none';
        }, error: function (response) {
            if (response.status == 422) {
                if (response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function (key, errorsArray) {
                        $.each(errorsArray, function (item, error) {
                            toastr.error(error);

                        });
                    });
                } else if (response.responseJSON.message) {
                    $.each(response.responseJSON.message, function (item, error) {
                        toastr.error(error);
                    });
                }
            } else if (response.responseJSON && response.responseJSON.message) {
                toastr.error(response.responseJSON.message);
            } else {
                toastr.error(response.message);
            }
            preloader.style.display = 'none';
        }
    });
});

/* ############# GENERAL FORM SUBMIT ################ */




/**
     * Master Checkbox trigger
     * */


$(document).on('change', '#master-checkbox', function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#master_checkbox)');
    const isChecked = this.checked;
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = isChecked;
    });
});
