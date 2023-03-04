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
                            <a href="{{route('admin#list')}}">
                                <div class="ms-5">
                                    <i class="fa-solid fa-arrow-left  fs-4 text-dark"></i>
                                </div>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#change', $account->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 my-5">
                                        @if ($account->image == null)
                                        @if ($account->gender == 'male')
                                        <img src="{{ asset('image/default_user.png') }}"
                                            class="image-thumbnail shadow-sm">
                                    @elseif ($account->gender == 'female')
                                        <img src="{{ asset('image/female_default.png') }}"
                                            class="image-thumbnail shadow-sm">
                                    @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image ) }}" alt="" />
                                        @endif
                                        
                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12">
                                                <i class="fa-solid fa-circle-arrow-right me-1"></i>Change
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row col-6 ">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament"  disabled name="name"
                                                value="{{ old('name', $account->name) }}" type="text"
                                                placeholder="Enter admin name:"
                                                class="form-control">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin')
                                                    selected
                                                @endif >Admin</option>
                                                <option value="user" @if ($account->role == 'user')
                                                    selected
                                                @endif>User</option>
                                            </select>
                                            {{-- <input id="cc-pament" name="role"
                                                value="{{ old('role', $account->role) }}" type="text"
                                                class="form-control"> --}}
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament"  disabled name="email"
                                                value="{{ old('email', $account->email) }}" type="email"
                                                placeholder="Enter admin email:"
                                                class="form-control">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament"  disabled name="phone"
                                                value="{{ old('phone', $account->phone) }}" type="number"
                                                placeholder="Enter admin phone:"
                                                class="form-control">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" id="" disabled 
                                                class="form-control ">
                                                <option value="">Choose gender..</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female"@if ($account->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address"  disabled value=""
                                                class="form-control"
                                                id="" cols="30" rows="10" placeholder="Enter admin address">{{ old('address', $account->address) }}</textarea>
                                            
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
