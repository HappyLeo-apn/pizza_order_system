
@extends('admin.layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
               
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        @if (session('accountSuccess'))
                            <div class="alert alert-success alert-dismissible fade show " role="alert">
                                <i class="fa-sharp fa-solid fa-circle-check"></i><strong>
                                    {{ session('accountSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-title">
                            <h3 class="text-center title-2">Modify User Profile</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#modifyUser', $userInfo->id )}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1 my-5">
                                    @if ($userInfo->image == null)
                                    @if ($userInfo->gender == 'male')
                                    <img src="{{ asset('image/default_user.png') }}"
                                        class="img-thumbnail shadow-sm w-100">
                                @elseif ($userInfo->gender == 'female')
                                    <img src="{{ asset('image/female_default.png') }}"
                                        class="img-thumbnail shadow-sm w-100">
                                @endif
                                    @else
                                        <img src="{{ asset('storage/' . $userInfo->image ) }}" class="image-thumbnail shadow-sm w-100"  />
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
                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name"
                                            value="{{ old('name', $userInfo->name) }}" type="text"
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
                                            value="{{ old('email', $userInfo->email) }}" type="email"
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
                                            value="{{ old('phone', $userInfo->phone) }}" type="number"
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
                                            <option value="male" @if ($userInfo->gender == 'male') selected @endif>
                                                Male</option>
                                            <option value="female"@if ($userInfo->gender == 'female') selected @endif>
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
                                            id="" cols="30" rows="10" placeholder="Enter admin address">{{ old('address', $userInfo->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role"
                                            value="{{ old('role', $userInfo->role) }}" type="text"
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
@endsection