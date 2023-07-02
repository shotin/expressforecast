  @extends('layouts.master')

@push('header')
    @include('components.header')
@endpush()

@section('content')
    <div class="container justify-content-center">
        <div class="card shadow col-md-7 mx-auto mx-auto mt-5 mb-5">
            <h1 class="text-center register_text">SIGN IN</h1>
            <form method="POST" action="{{ route('login') }}" class="p-3">
            {!! csrf_field() !!}
                <div class="mb-3 form-group">
                    <input placeholder="Email or Username" id="email" type="text" class="form-express w-100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <input id="password" placeholder="Password" type="password" class="form-express w-100" name="password" value="" required>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label text-express" for="customCheck1">
                        Remember Me
                    </label>
                    <a class="float-right express_link text-express" href="{{route('password.request')}}">Forgot Password?</a>
                </div>

                <div class="row mb-50">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block register">
                            {{ __('Login') }}
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
