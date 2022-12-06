@extends('layouts.user.master')

@section('title', __('Supports'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Supports') }}</li>
@endsection

@section('actions')
    <a href="{{ route('user.supports.index') }}" class="btn btn-sm btn-neutral">
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @if($support->images)
                    <div class="card">
                        <div class="card-header">
                            <!-- Title -->
                            <h5 class="h3 mb-0 font-weight-bolder">{{__('Attachments')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline timeline-one-side" data-timeline-content="axis"
                                 data-timeline-axis-style="dashed">
                                @foreach($support->images as $image)
                                    <div class="timeline-block">
                                        <span class="timeline-step badge-success">
                                          <i class="fa fa-file"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <div class="d-flex justify-content-between pt-1">
                                                <div>
                                                    <a href="{{ asset($image) }}" download>
                                                        <span class="text-muted text-sm">
                                                            {{ str($image)->explode('/')->last() }}
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="mb-0 font-weight-bolder">{{__('Log')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-one-side" data-timeline-content="axis"
                             data-timeline-axis-style="dashed">
                            <div class="timeline-block">
                              <span class="timeline-step badge-primary">
                                  <i class="fa fa-star"></i>
                              </span>
                                <div class="timeline-content">
                                    <small
                                        class="text-xs">{{ formatted_date($support->created_at, 'd M, Y - h:i A') }}</small>
                                    <h5 class="mt-3 mb-0">{{ $support->details }}</h5>
                                    <p class="text-sm mt-1 mb-0">{{ $support->user->name }}</p>
                                </div>
                            </div>
                            @foreach($support->meta as $reply)
                                @if($reply->type)
                                    <div class="timeline-block">
                                      <span class="timeline-step badge-primary">
                                        <i class="fa fa-star"></i>
                                      </span>
                                        <div class="timeline-content">
                                            <small
                                                class="text-xs">{{ formatted_date($reply->created_at, 'd M, Y - h:i A') }}</small>
                                            <h5 class="mt-3 mb-0">{{ $reply->comment }}</h5>
                                            <p class="text-sm mt-1 mb-0">{{ $support->user->name }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="timeline-block">
                                        <span class="timeline-step badge-success">
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <small
                                                class="text-xs">{{ formatted_date($reply->created_at, 'd M, Y - h:i A') }}</small>
                                            <h5 class="mt-3 mb-0">{{ $reply->comment }}</h5>
                                            <p class="text-sm mt-1 mb-0">
                                                {{ __("Administrator") }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($support->status)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 font-weight-bolder">{{__('Reply')}}</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('user.supports.update', $support->id) }}" method="post"
                                  class="init_form_validation">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <textarea name="comment" class="form-control no-border" placeholder="{{ __("Enter your message...") }}" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-neutral btn-sm">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
