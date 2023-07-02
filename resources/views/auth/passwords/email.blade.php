@extends('layouts.master')

@push('header')
    @include('components.header')
@endpush()

@section('content')
    <div class="container justify-content-center">
        <div class="col-md-7 mx-auto mt-10 mb-50">
            <h1 class="text-center register_text">Reset Password</h1>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="mt-20">
                @csrf
                <div class="mb-3 form-group">
                    <input placeholder="Email Address" id="email" type="email" class="form-express w-100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-50">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block register">
                            {{ __('Send Password Reset Link') }}
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
