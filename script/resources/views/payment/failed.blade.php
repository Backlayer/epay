@extends('layouts.user.blank')

@section('title', __('Transaction Failed'))

@section('body')
<div class="container ">
    <div class="row justify-content-center mt-3 align-items-center h-100vh">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="p-5 text-center">
                        {{ __('Transaction failed/cancel') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
