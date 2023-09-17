<div class="modal fade" id="create-edit-modal">
    <div class="modal-dialog modal-lg">
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
                            <div class="col-sm-6">
                                <h5>{{ __('backend.name_ar') }}</h5>
                                <input name="name_ar" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <h5>{{ __('backend.name_en') }}</h5>
                                <input name="name_en" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.offers.company') }}</h5>
                                <select class="form-control" name="company_id">
                                    <option value="">{{ __('backend.select') }}</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.discount') }}</h5>
                                <input name="discount_value" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.discount_type') }}</h5>
                                <select class="form-control" name="discount_type">
                                    <option value="">{{ __('backend.select') }}</option>
                                    @foreach ($discount_types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.end_date') }}</h5>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            <div class="col-sm-12 mt-4">
                                <h5>{{ __('backend.description_ar') }}</h5>
                                <textarea name="description_ar" class="summernote"></textarea>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <h5>{{ __('backend.description_en') }}</h5>
                                <textarea name="description_en" class="summernote"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('backend.save') }}</button>
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
