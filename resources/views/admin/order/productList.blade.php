@extends('admin.layouts.master')
@section('title', 'category list page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <a href="{{route('admin#orderList')}}" class="text-dark mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i>Back
            </a>
            <div class="card w-50">
                <h5 class="card-header"><i class="fa-solid fa-clipboard me-2"></i>Order Information</h5>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                        <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                        <div class="col">{{$orderList[0]->order_code}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col"><i class="fa-regular fa-clock me-2"></i>Order Date</div>
                        <div class="col">{{$orderList[0]->created_at->format('F-j-Y')}}</div>
                    </div>
                    <div class="row">
                        <div class="col"><i class="fa-solid fa-dollar-sign me-2"></i>Total Price</div>
                        <div class="col">{{$order->total_price}} -Ks <small class="text-danger fw-bold">(Delivery Fees included)</small></div>
                    </div>
                    
                    
                </div>
              </div>
               

                <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product ID</th>
                                
                                <th>Product Image</th>
                                <th>Product Name</th>
                                
                                <th>Quantity</th>
                                <th>Price</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderList as $o)
                               <tr>
                                    <td></td>
                                    <td>{{$o->product_id}}</td>
                                    
                                    <td class="col-2"><img src="{{asset('storage/'. $o->product_image)}}" class="img-thumbnail w-50" alt=""></td>
                                    <td>{{$o->product_name}}</td>

                                    <td>{{$o->qty}}</td>
                                    <td>{{$o->total}} -Ks</td>
                               </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">

                    </div>

                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

