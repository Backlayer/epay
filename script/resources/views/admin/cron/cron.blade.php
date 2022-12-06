@extends('layouts.backend.app')

@section('title', __('Cron Jobs'))

@section('content')
<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i> {{ __('Delete Temporary Files') }} <code>{{ __('Once/day') }}</code>
                </h6>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="temporary-files-cron" value=" * * * * * curl {{ route('cron.run.temporary-files') }} >> /dev/null 2>&1" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary clipboard-button" type="button" data-clipboard-target="#temporary-files-cron">
                            <i class="fas fa-clipboard"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i> {{ __('Delete Unpaid External Orders') }} <code>{{ __('Once/day') }}</code>
                </h6>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="delete-unpaid-external-orders" value=" * * * * * curl {{ route('cron.run.delete-unpaid-external-orders') }} >> /dev/null 2>&1" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary clipboard-button" type="button" data-clipboard-target="#delete-unpaid-external-orders">
                            <i class="fas fa-clipboard"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i> {{ __('Send Mail with Queue') }}</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="text-danger font-weight-bolder">
                        <strong>{{ __('Note:') }} :</strong> {{ __('You Need Add This Command In Your Supervisor And Also Make QUEUE_MAIL On From System Settings To Mail Configuration.') }}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="queue-supervisor" value="php {{ base_path() }}/artisan queue:work >> /dev/null 2>&1" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary clipboard-button" type="button" data-clipboard-target="#queue-supervisor">
                                <i class="fas fa-clipboard"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script src="{{ asset('admin/plugins/clipboard-js/clipboard.min.js') }}"></script>
    <script>
        "use strict";
        var clipboard = new ClipboardJS('.clipboard-button');

        clipboard.on('success', function(e) {
            Notify('success', null, 'Copied to clipboard')
            e.clearSelection();
        });
    </script>
@endpush
