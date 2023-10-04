<div class="modal fade" id="create-edit-modal">
    <div class="modal-dialog modal-md">
        <form action="" method="POST" class="custom-form">
            @csrf
            <input type="hidden" name="_method" id="">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>{{ __('backend.name_ar') }}</h5>
                                <input value="" name="name_ar" class="form-control">
                            </div>
                            <div class="col-sm-12 mt-4">
                                <h5>{{ __('backend.name_en') }}</h5>
                                <input name="name_en" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                    <button type="submit" class="btn btn-primary"
                        id="confrim-vin-btn">{{ __('backend.save') }}</button>
                    <button type="reset" hidden></button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
