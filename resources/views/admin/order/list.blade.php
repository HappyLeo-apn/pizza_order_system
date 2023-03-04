@extends('admin.layouts.master')
@section('title', 'category list page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">




                <div class="row">

                    {{-- <div class="col-3 offset-6">
                        <form action="{{ route('product#list') }}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="search"
                                    value="{{ request('key') }}">
                                <button class="btn btn-dark" type="submit"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div> --}}
                </div>
                <div class="row my-2">
                   
                </div>
                <form action="{{ route('admin#changeStatus') }}" method="get">
                    @csrf
                    
                    <div class="input-group">
                        
                           <div class="input-group-append">
                            <span class="input-group-text col bg-light shadow-sm">
                                <h4><i class="fa-solid fa-database me-2"></i> {{ count($order) }}</h4>
                            </span>
                           </div>
                        
                        <select name="orderStatus" class="form-control col-1">
                            <option value="">All</option>
                            <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                            <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                            <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                        </select>
                        <button type="submit" class="btn btn-dark"><i class="fas fa-search me-1"></i>Search</button>
                      </div>
                </form>

                <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>

                                <th>User ID</th>
                                <th>Username</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Price</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                                <tr class="tr-shadow ">
                                    <input type="hidden" id="orderId" value="{{ $o->id }}">

                                    <td class="col-2">{{ $o->user_id }}</td>
                                    <td class="col-2">{{ $o->user_name }}</td>
                                    <td class="col-2">{{ $o->created_at->format('F-j-Y') }}</td>
                                    <td class="col-2"><a href="{{route('admin#listInfo', $o->order_code)}}" class="text-primary">{{ $o->order_code }}</a></td>
                                    <td class="col-2">{{ $o->total_price }} -Ks</td>
                                    <td class="col-2">
                                        <select name="status" class="form-control statusChange">
                                            <option value="0" @if ($o->status == 0) selected @endif>Pending
                                            </option>
                                            <option value="1" @if ($o->status == 1) selected @endif>Accept
                                            </option>
                                            <option value="2" @if ($o->status == 2) selected @endif>Reject
                                            </option>
                                        </select>
                                    </td>


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
@section('scriptSection')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function(){
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //         type: "get",
            //         url : "http://127.0.0.1:8000/admin/order/ajax/status/",
            //         data: {
            //             'status':$status,
            //         },
            //         dataType: "json",
            //         success: function (response) {
            //            $list = "";
            //            for($i = 0; $i < response.length; $i++){
            //             $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November'];
            //             $dbDate = new Date(response[$i].created_at);
            //             $fianlDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() + '-' + $dbDate.getFullYear();
            //             if(response[$i].status == 0){
            //                 $statusMessage = `
        //                 <select name="status" id="" class="form-control statusChange">
        //                                 <option value="0" selected>Pending
        //                                 </option>
        //                                 <option value="1">Accept
        //                                 </option>
        //                                 <option value="2">Reject
        //                                 </option>
        //                             </select>
        //                 `;
            //             }
            //             else if(response[$i].status == 1){
            //                 $statusMessage = `
        //                 <select name="status" id="" class="form-control statusChange">
        //                                 <option value="0" >Pending
        //                                 </option>
        //                                 <option value="1" selected>Accept
        //                                 </option>
        //                                 <option value="2">Reject
        //                                 </option>
        //                             </select>
        //                 `;
            //             }
            //             else if(response[$i].status == 2){
            //                 $statusMessage = `
        //                 <select name="status" id="" class="form-control statusChange">
        //                                 <option value="0" >Pending
        //                                 </option>
        //                                 <option value="1" >Accept
        //                                 </option>
        //                                 <option value="2" selected>Reject
        //                                 </option>
        //                             </select>
        //                 `;
            //             }
            //             $list += `
        //             <tr class="tr-shadow ">
        //                         <input type="hidden" id="orderId" value="${ response[$i].id }">
        //                         <td class="col-2">${ response[$i].user_id }</td>
        //                         <td class="col-2">${ response[$i].user_name }</td>
        //                         <td class="col-2">${ $fianlDate }</td>
        //                         <td class="col-2">${ response[$i].order_code }</td>
        //                         <td class="col-2">${ response[$i].total_price } -Ks</td>
        //                         <td class="col-2">
        //                             ${$statusMessage}
        //                         </td>


        //                     </tr>
        //             `;
            //            }
            //            $('#dataList').html($list);
            //         }
            //     });
            // })
            $('.statusChange').change(function() {
                $parentNode = $(this).parents('tr');
                $currentStatus = $(this).val();
                $orderId = $parentNode.find('#orderId').val();
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                };
                $.ajax({
                    type: "get",
                    url: "/admin/order/ajax/change/status/",
                    data: $data,
                    dataType: "json",

                });
            })
        })
    </script>
@endsection
