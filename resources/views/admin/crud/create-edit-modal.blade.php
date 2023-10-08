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
                                <input name="name_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <h5>{{ __('backend.name_en') }}</h5>
                                <input name="name_en" class="form-control" required>
                            </div>
                            {{-- web img --}}
                            <div class="col-sm-12 mt-5">
                                <label for="">{{ __('backend.web_img') }} <b><small>150X150</small></b></label>
                                <div class="avatar-picture text-center">
                                    <div class="image-input image-input-outline" id="imgUserProfile">
                                        <div class="image-input-wrapper-web"
                                            style="background-image: url('{{ asset('dist/img/product-placeholder.webp') }}');">
                                        </div>
                                        <label class="btn">
                                            <i>
                                                <img src="{{ asset('dist/img/edit.svg') }}" alt=""
                                                    class="img-fluid">
                                            </i>
                                            <input type="file" name="web_img" id="changeImgWeb"
                                                accept=".png, .jpg, .jpeg, .webp">
                                            <input type="button" value="Upload" id="uploadButtonWeb">
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{-- mobile img --}}
                            <div class="col-sm-12 mt-5">
                                <label for="">{{ __('backend.mobile_img') }} <b><small>80X80</small></b></label>
                                <div class="avatar-picture text-center">
                                    <div class="image-input image-input-outline" id="imgUserProfile">
                                        <div class="image-input-wrapper-mobile"
                                            style="background-image: url('{{ asset('dist/img/product-placeholder.webp') }}');">
                                        </div>
                                        <label class="btn">
                                            <i>
                                                <img src="{{ asset('dist/img/edit.svg') }}" alt=""
                                                    class="img-fluid">
                                            </i>
                                            <input type="file" name="mobile_img" id="changeImgMobile"
                                                accept=".png, .jpg, .jpeg, .jpeg">
                                            <input type="button" value="Upload" id="uploadButtonMobile">
                                        </label>

                                    </div>
                                </div>
                            </div>
                            {{-- Description For Service Only --}}
                            <div class="col-sm-12">
                                <h5>{{ __('backend.description_ar') }}</h5>
                                <textarea name="description_ar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12">
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
