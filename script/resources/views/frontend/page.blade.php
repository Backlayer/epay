@extends('layouts.frontend.app')

@section('title', $page->title)

@section('content')
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area-single">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content-text">
                        <h6>{{ $page->title }}</h6>
                        <h3>{{ json_decode($page->pageMeta->value)->page_excerpt ?? '' }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area -->


    <!-- BLog Area -->
    <div class="terms-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="privacy-content-text">
                        <div class="terms-content-text">
            {{ content_format(json_decode($page->pageMeta->value)->page_content) }}
                    </div>
                 </div>
             </div>
         </div>
     </div>    
      </div>    
    <!-- BLog Area -->
@endsection
