@extends('user.layouts.master')
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5 mt-5">

        <div class="row px-xl-5">

            <div class="col-lg-5 mb-30">
                <a href="{{ route('user#home') }}" class="text-dark text-decoration-none fs-5">
                    <i class="fa-solid fa-arrow-left me-2"></i> Back</a>
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                        <small class="pt-1">{{ $pizza->view_count + 1 }} <i class="fa-solid fa-eye"></i></small>
                        <input type="hidden" value="{{Auth::user()->id}}" name="" id="currentUserId">
                            <input type="hidden" name="" value="{{$pizza->id}}" id="currentPizzaId">
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} - Ks</h3>
                    <p>{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control  border-0 text-center" id="orderCount" value="1">
                            
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i class="fa fa-shopping-cart text-light mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase bg-dark mx-xl-5 mb-4 p-2 text-center rounded"><span class="pr-3 text-warning fw-bold">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">

                    @foreach ($pizzaList as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}" style="height:360px"
                                    alt="">
                                <div class="product-action text-center mt-1 bg-warning p-2 ">
                                    <a class="btn btn-outline-dark btn-square text-white" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square text-white"
                                        href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }} -ks</h5>
                                    <h6 class="text-muted ml-2"></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){

            //increase view count
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/user/ajax/increase/viewCount",
                data: {
                    'userId': $('#currentUserId').val(),
                    'productId' : $('#currentPizzaId').val(),
                },
                dataType: "dataType",
                success: function (response) {
                    
                }
            });




            $('#addCartBtn').click(function(){
                
                $source = {
                    'userId' : $('#currentUserId').val(),
                    'pizzaId' : $('#currentPizzaId').val(),
                    'count' : $('#orderCount').val(),
                }
                $.ajax({
                    type : 'get',
                    data : $source,
                    url : "http://127.0.0.1:8000/user/ajax/addToCart",
                    dataType : 'json',
                    success : function(response){
                       if(response.status == 'success'){
                        window.location.href = "http://127.0.0.1:8000/user/homePage";
                       }
                    }
                    
                })

                
            })
        })
    </script>
@endsection