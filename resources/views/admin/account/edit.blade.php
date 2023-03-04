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
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 my-5">
                                        @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                        <img src="{{ asset('image/default_user.png') }}"
                                            class="img-thumbnail shadow-sm">
                                    @elseif (Auth::user()->gender == 'female')
                                        <img src="{{ asset('image/female_default.png') }}"
                                            class="image-thumbnail shadow-sm">
                                    @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image ) }}" alt="" />
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image" class="form-control @error('image')
                                            is-invalid
                                        @enderror">
                                        @error('image')
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
                                            <input id="cc-pament" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" type="text"
                                                placeholder="Enter admin name:"
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" type="email"
                                                placeholder="Enter admin email:"
                                                class="form-control @error('email')
                                                is-invalid
                                            @enderror">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}" type="number"
                                                placeholder="Enter admin phone:"
                                                class="form-control @error('phone')
                                                is-invalid
                                            @enderror">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" id=""
                                                class="form-control @error('gender')
                                            is-invalid
                                        @enderror">
                                                <option value="">Choose gender..</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female"@if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" value=""
                                                class="form-control @error('address')
                                            is-invalid
                                        @enderror"
                                                id="" cols="30" rows="10" placeholder="Enter admin address">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role"
                                                value="{{ old('role', Auth::user()->role) }}" type="text"
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
