<div class="modal fade" id="create-edit-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            @csrf
            <input type="hidden" name="_method" id="">
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
                            <input type="text" name="subscribtion_id_to_confirm">
                            <input type="text" name="current_vin">
                            <h5>{{ __('backend.club_being_subscribed') }}</h5>
                            <input readonly value="" name="current_club" class="form-control">
                        </div>
                        <div class="col-sm-12 mt-4">
                            <h5>{{ __('backend.subscribtion_date') }}</h5>
                            <input name="subscribtion_date" readonly class="form-control">
                        </div>
                        <div class="col-sm-12 mt-4">
                            <h5>{{ __('backend.subscribtion_total_amount') }}</h5>
                            <input name="paid_amount" readonly class="form-control">
                        </div>
                        <div class="col-sm-12 mt-4">
                            <h5> <i class="fa fa-file"></i> {{ __('backend.attached_file') }}</h5>
                            <a href="" target="_blank" id="file-to-view"><i
                                    class="fa fa-eye text-success"></i></a>&nbsp;&nbsp;
                            <a href="" id="file-to-download"><i class="fa fa-download text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('backend.cancel') }}</button>
                <button type="submit" class="btn btn-primary"
                    id="confrim-vin-btn">{{ __('backend.confirm_vin') }}</button>
                <button type="reset" hidden></button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
