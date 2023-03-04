
@extends('user.layouts.master')
@section('content')
<div class="main-content mt-3 p-4">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
           
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change your password!</h3>
                        </div>
                        @if (session('changeSuccess'))
                            <div class="alert alert-success alert-dismissible fade show " role="alert">
                                <i class="fa-sharp fa-solid fa-circle-check"></i><strong>
                                    {{ session('changeSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('notMatch'))
                            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i><strong>
                                    {{ session('notMatch') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <hr>
                        <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group my-3">
                                <label class="control-label mb-1">Old Password:</label>
                                <input name="oldPassword" placeholder="Old Password" class="form-control">

                            </div>
                            <div class="form-group my-3">
                                <label for="cc-payment" class="control-label mb-1">New Password:</label>
                                <input id="cc-pament" name="newPassword" type="password"
                                    value="{{ old('newPassword') }}"
                                    class="form-control @error('newPassword')
                                    is-invalid
                                @enderror"
                                    aria-required="true" aria-invalid="false" placeholder="New password">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password:</label>
                                <input id="cc-pament" name="confirmPassword" type="password"
                                    value="{{ old('confirmPassword') }}"
                                    class="form-control @error('confirmPassword')
                                    is-invalid
                                @enderror"
                                    aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class=" my-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block w-100 my-2">
                                    <i class="fa-solid fa-key"></i> <span id="payment-button-amount"> Change
                                        Password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection