@push('css')
    <style>
        #show-info div .row {
            border-bottom: 1px solid lightgray;
        }

        a {
            cursor: pointer;
        }
    </style>
@endpush
<div class="modal fade" id="show-info">
    <div class="modal-dialog modal-lg">
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
                        <div class="col-sm-6">
                            <h5>{{ __('custom.Project No.') }}</h5>
                            <span id="modal-project-no"></span>
                        </div>
                        <div class="col-sm-6">
                            <h5> {{ __('custom.Land No') }} </h5>
                            <span id="modal-project-land-no"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>{{ __('custom.Land Area') }}</h5>
                            <span id="modal-project-land-area"></span>
                        </div>
                        <div class="col-sm-6">
                            <h5>{{ __('custom.Budget') }}</h5>
                            <span id="modal-project-budget">
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>{{ __('custom.Client') }}</h5>
                            <span id="modal-project-client"></span>
                        </div>
                        <div class="col-sm-6">
                            <h5>{{ __('custom.Consultant') }}</h5>
                            <span id="modal-project-consultant"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>{{ __('custom.Consultant Total Budget') }}</h5>
                            <span id="modal-project-consultant-budget"></span>
                        </div>
                        <div class="col-sm-6">
                            <h5>{{ __('custom.Delegator') }}</h5>
                            <span id="modal-project-delegator"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>
                                {{ __('custom.Delegator Total Budget') }}
                            </h5>
                            <span id="modal-project-delegator-budget"></span>
                        </div>
                        <div class="col-sm-6">
                            <h5>
                                {{ __('custom.Contractor') }}
                            </h5>
                            <span id="modal-project-contractor"></span>
                        </div>
                    </div>
                    <div class="row p-5">
                        <div class="col-sm-4">
                            <a id="delegator-transactionp-route" class="btn btn-info white-color"><i
                                    class="fa fa-download"></i> {{ __('custom.sidebar.delegate_transactions') }}</a>
                        </div>
                        <div class="col-sm-4">
                            <a id="application-fees-route" class="btn btn-primary white-color"><i
                                    class="fa fa-download"></i> {{ __('custom.sidebar.application_fees') }}</a>
                        </div>
                        <div class="col-sm-4">
                            <a id="tender-pdf-route" class="btn btn-success white-color"><i
                                    class="fa fa-download"></i> {{ __('custom.sidebar.tenders') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('custom.close') }}</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
