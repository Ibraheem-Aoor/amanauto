<div class="modal fade" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form name="confirm-delete-form">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('custom.Caution') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">{{__('custom.close')}}</button>
                    <button type="submit" class="btn btn-outline-light">{{__('custom.delete')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
