@extends('layouts.backend.app', [
   'button_name'=> __('Create New'),
   'button_link'=> route('admin.reviews.create')
])

@section('title', __('Reviews'))

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="float-left">
                  <h6 class="text-primary">{{ __('Reviews') }}</h6>
               </div>
               <div class="float-right">
                  <form method="get">
                     <div class="input-group">
                        <input name="src" type="text" value="{{ request('src') }}" class="form-control" placeholder="search...">
                        <div class="input-group-append">
                           <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="clearfix mb-3"></div>
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr class="text-center">
                           <th>{{ __('Image') }}</th>
                           <th>{{ __('Name') }}</th>
                           <th>{{ __('Rating (5)') }}</th>
                           <th>{{ __('Comment') }}</th>
                           <th>{{ __('Created At') }}</th>
                           <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($reviews as $review)
                        <tr class="text-center">
                           <td>
                               <img src="{{ $review->value['image'] ?? null }}" class="avatar" alt="">
                           </td>
                            <td class="text-left">{{ $review->value['name'] ?? null }}</td>
                            <td>
                                {{ $review->value['rating'] ?? null }}
                                <span class="text-warning">
                                    <i class="fas fa-star"></i>
                                </span>
                            </td>
                            <td>{{ $review->value['comment'] ?? null }}</td>
                            <td>{{ formatted_date($review->created_at) }}</td>
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Action') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="{{ route('admin.reviews.edit', $review->id) }}">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>

                                    <a class="dropdown-item has-icon delete-confirm" href="javascript:void(0)" data-action="{{ route('admin.reviews.destroy', $review->id) }}">
                                        <i  class="fa fa-trash"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  {{ $reviews->links('vendor.pagination.bootstrap-5') }}
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
