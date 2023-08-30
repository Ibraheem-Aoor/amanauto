@push('css')
    <style>
        #show-info div .row {
            border-bottom: 1px solid lightgray;
        }
    </style>
@endpush
<div class="modal fade" id="create-edit-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="custom-form" action="" method="POST">
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
                            <div class="col-sm-12 text-center">
                                <h5>{{ __('custom.Name') }}</h5>
                                <input id="model-name" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
