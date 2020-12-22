@extends('layouts.auth')

@section('content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-md-4 p-0 align-self-center">
            <div class="card" id="card-login">
                <div class="card-header text-center">
                    <h4>{{ __('Reset Password') }}</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 p-0" id="banner" style="background-image: url({{ asset('images/auth.jpeg') }})"></div>
    </div>
</div>
@endsection