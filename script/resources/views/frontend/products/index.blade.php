@extends('layouts.frontend.product')

@section('title', __('Products'))

@section('content')
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-text d-sm-flex justify-content-between align-items-center">
                        <h2>All Products</h2>
                        <div class="breadcrumb-dropdown d-flex align-items-center">
                            <div class="dropdown">
                                <a class="product-dro-btn dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    Export
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Export Prices</a></li>
                                    <li><a class="dropdown-item" href="#">Export products</a></li>
                                </ul>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="product-dro-btn two" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                <i class="fas fa-plus"></i> Add Product
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area -->


    <!-- Product Area -->
    <div class="product-area section-padding-0-50">
        <div class="container">
            <div class="row">
                <!-- Single Product Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-product-area text-center">
                        <!-- product img -->
                        <div class="product-img">
                            <img src="{{ asset('frontend/img/bg-img/p-1.jpg') }}" alt="">
                        </div>
                        <span class="product-badge">New</span>
                        <div class="product-compare">
                            <a href="#"><i class="fas fa-exchange-alt"></i></a>
                        </div>
                        <div class="product-love">
                            <a href="#"><i class="far fa-heart"></i></a>
                        </div>
                        <div class="product-text">
                            <h6>HAVIT</h6>
                            <h5>Gues Slim Taper Fit Jeans</h5>
                            <p>Price: $49</p>
                            <!-- product details area -->
                            <div class="product-details-area ">


                                <div class="cart-btn">
                                    <a href="#">Shop product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Product Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-product-area text-center">
                        <!-- product img -->
                        <div class="product-img">
                            <img src="{{ asset('frontend/img/bg-img/p-2.jpg') }}" alt="">
                        </div>
                        <span class="product-badge">New</span>
                        <div class="product-compare">
                            <a href="#"><i class="fas fa-exchange-alt"></i></a>
                        </div>
                        <div class="product-love">
                            <a href="#"><i class="far fa-heart"></i></a>
                        </div>
                        <div class="product-text">
                            <h6>HAVIT</h6>
                            <h5>Gues Slim Taper Fit Jeans</h5>
                            <p>Price: $49</p>
                            <!-- product details area -->
                            <div class="product-details-area ">


                                <div class="cart-btn">
                                    <a href="#">Shop product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Product Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-product-area text-center">
                        <!-- product img -->
                        <div class="product-img">
                            <img src="{{ asset('frontend/img/bg-img/p-3.jpg') }}" alt="">
                        </div>

                        <div class="product-compare">
                            <a href="#"><i class="fas fa-exchange-alt"></i></a>
                        </div>
                        <div class="product-love">
                            <a href="#"><i class="far fa-heart"></i></a>
                        </div>
                        <div class="product-text">
                            <h6>HAVIT</h6>
                            <h5>Gues Slim Taper Fit Jeans</h5>
                            <p>Price: $49</p>
                            <!-- product details area -->
                            <div class="product-details-area ">


                                <div class="cart-btn">
                                    <a href="#">Shop product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Product Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-product-area text-center">
                        <!-- product img -->
                        <div class="product-img">
                            <img src="{{ asset('frontend/img/bg-img/p-2.jpg') }}" alt="">
                        </div>

                        <div class="product-compare">
                            <a href="#"><i class="fas fa-exchange-alt"></i></a>
                        </div>
                        <div class="product-love">
                            <a href="#"><i class="far fa-heart"></i></a>
                        </div>
                        <div class="product-text">
                            <h6>HAVIT</h6>
                            <h5>Gues Slim Taper Fit Jeans</h5>
                            <p>Price: $49</p>
                            <!-- product details area -->
                            <div class="product-details-area ">


                                <div class="cart-btn">
                                    <a href="#">Shop product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Product Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-product-area text-center">
                        <!-- product img -->
                        <div class="product-img">
                            <img src="{{ asset('frontend/img/bg-img/p-1.jpg') }}" alt="">
                        </div>
                        <span class="product-badge">New</span>
                        <div class="product-compare">
                            <a href="#"><i class="fas fa-exchange-alt"></i></a>
                        </div>
                        <div class="product-love">
                            <a href="#"><i class="far fa-heart"></i></a>
                        </div>
                        <div class="product-text">
                            <h6>HAVIT</h6>
                            <h5>Gues Slim Taper Fit Jeans</h5>
                            <p>Price: $49</p>
                            <!-- product details area -->
                            <div class="product-details-area ">


                                <div class="cart-btn">
                                    <a href="#">Shop product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Product Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-product-area text-center">
                        <!-- product img -->
                        <div class="product-img">
                            <img src="{{ asset('frontend/img/bg-img/p-3.jpg') }}" alt="">
                        </div>
                        <span class="product-badge">New</span>
                        <div class="product-compare">
                            <a href="#"><i class="fas fa-exchange-alt"></i></a>
                        </div>
                        <div class="product-love">
                            <a href="#"><i class="far fa-heart"></i></a>
                        </div>
                        <div class="product-text">
                            <h6>HAVIT</h6>
                            <h5>Gues Slim Taper Fit Jeans</h5>
                            <p>Price: $49</p>
                            <!-- product details area -->
                            <div class="product-details-area ">


                                <div class="cart-btn">
                                    <a href="#">Shop product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="shop_pagination_area mt-30 mb-50">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa fa-angle-left"
                                                                     aria-hidden="true"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">8</a></li>
                                <li class="page-item"><a class="page-link" href="#">9</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa fa-angle-right"
                                                                     aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area -->
@endsection
