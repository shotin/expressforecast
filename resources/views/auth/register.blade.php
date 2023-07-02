@extends('layouts.master')

@push('header')
    @include('components.header')
@endpush()

@section('content')
<div class="container justify-content-center">
    <div class="card shadow col-md-6 mx-auto mt-5 mb-5">
        <h1 class="text-center register_text">Register</h1>
        <p class="justify-content-center register_subtitle mb-2 text-justify p-3">Register on {{strtolower(env('APP_NAME'))}} to get access to free lotto forecast for your favorite Nigerian lotto games to increase your chances of winning. These forecasts are AI driven to give you the best accuracy and forecasts.</p>
        <form method="POST" action="{{ route('register') }}" class="p-3">
            @csrf
            <div class="mb-3 form-group">
                <input placeholder="Full name" id="name" type="text" class="form-express w-100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <input id="phone" placeholder="Phone Number" type="text" class="form-express w-100 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <input placeholder="Email" id="email" type="email" class="form-express w-100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <input placeholder="Password" id="password" type="password" class="form-express w-100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-express w-100" name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- <div class="form-group mb-3"> 
                <!-- <strong>Google recaptcha :</strong> 
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
            </div> -->


            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label text-express " for="customCheck1">
                    I have read the <a href="#">Terms and Conditions</a>
                </label>
            </div>

            <div class="row mb-50">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block register">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('footer')
    @include('components.footer')
@endpush()
