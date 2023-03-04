@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid mt-3" style="height: 55vh">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">

                <table class="table table-light table-borderless table-hover text-center mb-4" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                           
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{$o->created_at->format('F-j-Y')}}</td>
                            <td class="align-middle">{{$o->order_code}}</td>
                            <td class="align-middle">{{$o->total_price}}</td>
                            <td class="align-middle">
                                @if ($o->status == 0)
                                    <span class="text-warning shadow-lg"><i class="fa-solid fa-clock"></i> pending..</span>
                                @elseif($o->status ==1)
                                    <span class="text-success shadow-lg"><i class="fa-solid fa-check"></i> Success</span>
                                @elseif ($o->status ==2)
                                    <span class="text-danger shadow-lg"><i class="fa-solid fa-triangle-exclamation"></i> Reject</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                        @endforeach
            
                    </table>
                    <span>{{$order->links()}}</span>
            </div>
            
        </div>
    </div>
    <!-- Cart End -->
@endsection
