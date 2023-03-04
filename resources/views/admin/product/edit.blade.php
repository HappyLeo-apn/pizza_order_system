@extends('admin.layouts.master')
@section('title', 'category list page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7 mb-2">
                @if (session('accountSuccess'))
                                <div class="alert alert-success alert-dismissible fade show " role="alert">
                                    <i class="fa-sharp fa-solid fa-circle-check"></i><strong>
                                        {{ session('accountSuccess') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        
                        <div class="card-body">
                            
                                <div class="ms-5">
                                    <i class="fa-solid fa-arrow-left text-dark fs-2" onclick="history.back()"></i>
                                </div>
                            
                            <div class="card-title">
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                   
                                    <img src="{{ asset('storage/' . $pizza->image) }}" alt="" />
                                            
                                </div>
                                <div class="col-7">
                                    <div class="my-3 btn btn-danger d-block col-6 fs-4"> {{$pizza->name}}</div>
                                    <span class="my-3 btn btn-dark"><i class="fs-4 fa-solid fa-dollar-sign me-2"></i>{{$pizza->price}} -Ks</span>
                                    
                                    <span class="my-3 btn btn-dark"><i class="fs-4 fa-solid fa-eye me-2"></i>{{$pizza->view_count}}<span> view (s)</span></span>
                                    <span class="my-3 btn btn-dark"><i class="fs-4 fa-solid fa-stopwatch me-2"></i>{{$pizza->waiting_time}} <span>mins</span></span>
                                    <span class="my-3 btn btn-dark"><i class="fs-4 fa-solid fa-clone me-2"></i>{{$pizza->category_name}}</span>
                                    <span class="my-3 btn btn-dark"><i class="fs-4 fa-solid fa-user-clock me-2"></i>{{$pizza->created_at->format('j-F-Y')}}</span>
                                    
                                    <div class="my-3"><i class="fs-4 fa-solid fa-circle-info me-2"></i>Details</div>
                                    <div>{{$pizza->description}}</div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
