@extends('layouts.backend.app')

@section('title', __('Charges'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('TRX') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Log') }}</th>
                                <th>{{ __('Created At') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
