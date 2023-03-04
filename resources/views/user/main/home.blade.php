@extends('user.layouts.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid mt-4">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by
                        categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-2">

                            <label class="mt-2" for="price-all">Category</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-2">

                            <a href="{{ route('user#home') }}" class="text-dark"> <label class=""
                                    for="price-5">All</label></a>

                        </div>
                        @foreach ($category as $c)
                            <div class="d-flex align-items-center justify-content-between pt-2">

                                <a href="{{ route('user#filter', $c->id) }}" class="text-dark"> <label class=""
                                        for="price-5">{{ $c->name }}</label></a>

                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">


                <a href="{{ route('user#cartList') }}">
                    <div type="button" class="btn btn-dark position-relative">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($cart) }}

                        </span>
                    </div>
                </a>
                <a href="{{ route('user#history') }}" class="ms-2">
                    <div type="button" class="btn btn-dark position-relative">
                        <i class="fa-solid fa-history"></i> History
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($history) }}

                        </span>
                    </div>
                </a>

                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">

                                <div class="dropdown">

                                    <select name="sorting" id="sortOption" class="form-control">
                                        <option value="" selected>Sorted By...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden text-center rounded">
                                            <img class="img-fluid mb-1 rounded" style="width:356px;height: 270px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">

                                            <div class="product-action bg-dark py-2 rounded">
                                                <a class="btn btn-outline-light btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-light btn-square"
                                                    href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>
                                                <h6 class="text-muted ml-2"></h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="shadow-sm mt-4 p-3 fs-1 text-center text-secondary">There is no product in this
                                category <i class="fa-solid fa-pizza-slice"></i></h3>
                        @endif
                    </div>




                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
   <script>
        $(document).ready(function(){
            $('#sortOption').change(function(){
             $eventOption = $("#sortOption").val();
             if($eventOption == "asc"){
                $.ajax({
                    type: "get",
                    url: "/user/ajax/pizza/List",
                    data: {
                        'status' : 'asc'
                    },
                    dataType: "json",
                    success: function (response) {
                        
                        $list = "";
                        for($i = 0; $i < response.length; $i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden text-center rounded">
                                            <img class="img-fluid mb-1 rounded" style="width:356px;height: 270px"
                                                src="{{ asset('storage/${response[$i].image}') }}" alt="">

                                            <div class="product-action bg-dark py-2 rounded">
                                                <a class="btn btn-outline-light btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-light btn-square"
                                                    href="{{ route('user#pizzaDetails', ${response[$i].id}) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href=""> ${response[$i].name} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                                <h6 class="text-muted ml-2"></h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        $('#dataList').html($list);
                        
                    }
                    
                });
             }

            else if($eventOption == "desc"){
                $.ajax({
                    type: "get",
                    url: "/user/ajax/pizza/List",
                    data: {
                        'status' : 'desc'
                    },
                    dataType: "json",
                    success: function (response) {
                        $list = "";
                        for($i = 0; $i < response.length; $i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden text-center rounded">
                                            <img class="img-fluid mb-1 rounded" style="width:356px;height: 270px"
                                                src="{{ asset('storage/${response[$i].image}') }}" alt="">

                                            <div class="product-action bg-dark py-2 rounded">
                                                <a class="btn btn-outline-light btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-light btn-square"
                                                    href="{{ route('user#pizzaDetails', 1) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href=""> ${response[$i].name} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5>
                                                <h6 class="text-muted ml-2"></h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        $('#dataList').html($list);
                        
                    }
                    
                });
             }
            })
        })
    </script> 
@endsection
