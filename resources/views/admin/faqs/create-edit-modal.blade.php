<div class="modal fade" id="create-edit-modal">
    <div class="modal-dialog modal-md">
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
                            <div class="col-sm-12">
                                <h5>{{ __('backend.cq.question_ar') }}</h5>
                                <textarea name="question_ar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h5>{{ __('backend.cq.question_en') }}</h5>
                                <textarea name="question_en" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h5>{{ __('backend.cq.answer_ar') }}</h5>
                                <textarea name="answer_ar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h5>{{ __('backend.cq.answer_en') }}</h5>
                                <textarea name="answer_en" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                    <button type="reset" hidden></button>
                    <button type="submit" class="btn btn-primary">{{ __('backend.save') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
