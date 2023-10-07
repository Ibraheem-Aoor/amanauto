<div class="modal fade" id="confirm-vin-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form class="custom-form" action="{{ route('admin.subscribtions.confirm') }}" method="POST">
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
                                <h5>{{ __('general.vin') }}</h5>
                                <input name="vin" class="form-control">
                                <input type="hidden" name="subscribtion_id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('backend.confirm_vin') }}</button>
                    <button type="reset" hidden></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
