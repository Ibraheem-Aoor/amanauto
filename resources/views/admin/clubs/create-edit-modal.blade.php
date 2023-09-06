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
                            <div class="col-sm-6">
                                <h5>{{ __('backend.name_ar') }}</h5>
                                <input name="name_ar" class="form-control">
                            </div>
                            <div class="col-sm-6 ">
                                <h5>{{ __('backend.name_en') }}</h5>
                                <input name="name_en" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.services') }}</h5>
                                <select class="select2  select2-hidden-accessible" multiple=""
                                    data-placeholder="Select a State" data-dropdown-css-class="select2-purple"
                                    style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true" name="services[]">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.price') }}</h5>
                                <input name="price" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.color') }}</h5>
                                <input type="color"  name="color" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.duration') }}</h5>
                                <input name="duration" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.duration_type') }}</h5>
                                <select class="form-control" name="duration_type">
                                    <option value="">{{ __('backend.select') }}</option>
                                    @foreach ($duration_types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5>{{ __('backend.times') }}</h5>
                                <input name="times" class="form-control"
                                    placeholder="{{ __('backend.unlimited_tip') }}">
                            </div>
                            <div class="col-sm-12 mt-4">
                                <h5>{{ __('backend.description_ar') }}</h5>
                                <textarea name="description_ar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <h5>{{ __('backend.description_en') }}</h5>
                                <textarea name="description_en" class="form-control"></textarea>
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
