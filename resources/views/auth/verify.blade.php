@extends('layouts.auth')

@section('content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-md-4 p-0 align-self-center">
            <div class="card" id="card-login">
                <div class="card-header text-center">
                    <h4>{{ __('Verify Your Email Address') }}</h4>
                </div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 p-0" id="banner" style="background-image: url({{ asset('images/auth.jpg') }})"></div>
    </div>
</div>
@endsection