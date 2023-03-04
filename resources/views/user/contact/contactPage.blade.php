@extends('user.layouts.master')
@section('content')
    <div class="container mt-3 p-5">
        <h3 class="text-center fw-bold text-secondary mb-4">Contact Us</h3>
        <form action="{{ route('user#sendMessage') }}" class="mt-3 col-5 mx-auto" method="post">
            @csrf
            <label for="name" class="form-label">Username :</label>
            <input type="text" name="contactUserName" id="name"
                class="form-control @error('contactUserName')
        is-invalid
    @enderror">
            @error('contactUserName')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <label for="email" class="form-label ">Email :</label>
            <input type="email" name="contactUserEmail" id="email"
                class="form-control @error('contactUserEmail')
            is-invalid
        @enderror">
            @error('contactUserEmail')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <label for="message" class="mt-1 form-label">Your Message For Us :</label>
            <textarea name="contactMessage" id="" cols="30" rows="10"
                class="form-control @error('contactMessage')
            is-invalid
        @enderror"></textarea>
            @error('contactMessage')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <button type="submit" class="btn btn-dark mt-3 w-100"><i
                    class="fa-solid fa-comment-dots me-2"></i>Send</button>
        </form>
    </div>
@endsection

