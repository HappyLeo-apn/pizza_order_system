@extends('admin.layouts.master')
@section('title', 'category list page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                               <a href="{{route('product#list')}}">
                                <i class="fa-solid fa-arrow-left text-dark fs-2"></i></a>
                            </div>
                        
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-4 offset-1 my-5">
                                        <img src="{{ asset('storage/' . $pizza->image) }}" alt=""
                                            class="col-6 offset-3 img-thumbnail shadow-sm" />

                                        <input type="hidden" name="pizzaId" value="{{$pizza->id}}">

                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage"
                                                class="form-control @error('pizzaImage')
                                            is-invalid
                                        @enderror">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12">
                                                <i class="fa-solid fa-circle-arrow-right me-1"></i>Update
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row col-6 ">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" value="{{ old('pizzaName', $pizza->name) }}"
                                                type="text" placeholder="Enter admin name:"
                                                class="form-control @error('pizzaName')
                                                is-invalid
                                            @enderror">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea id="cc-pament" name="pizzaDescription" type="text" placeholder="Enter pizza description:"
                                                class="form-control @error('pizzaDescription')
                                                is-invalid
                                            @enderror">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice"
                                                value="{{ old('pizzaPrice', $pizza->price)}}" type="number"
                                                placeholder="Enter pizza price:"
                                                class="form-control @error('pizzaPrice')
                                                is-invalid
                                            @enderror">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time)}}" type="number"
                                                placeholder="Enter the waiting time:"
                                                class="form-control @error('pizzaWaitingTime')
                                                is-invalid
                                            @enderror">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="viewCount"
                                                value="{{ old('viewCount', $pizza->view_count)}}" type="number"
                                                placeholder="Enter the view count:"
                                                class="form-control" disabled>
                                            
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" id=""
                                                class="form-control @error('pizzaCategory')
                                            is-invalid
                                        @enderror">
                                                <option value="">Choose category..</option>
                                                @foreach ($category as $c)
                                                
                                                    <option value="{{$c->id}}" @if($pizza->category_id  == $c->id) selected @endif>{{$c->name}}</option>
                                                @endforeach

                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Date</label>
                                            <input id="cc-pament" name="createdAt"
                                                value="{{ old('role', $pizza->created_at->format('j-F-Y')) }}" type="text"
                                                class="form-control" disabled>
                                        </div>

                                    </div>
                                </div>


                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
