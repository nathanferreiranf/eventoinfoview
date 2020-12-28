@extends('layouts.auth')

@section('content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-md-4 p-0 align-self-center">
            <form method="POST" action="{{ route('register') }}">

                <input type="hidden" name="id_evento" value="{{ $evento->id }}" />
                <div class="card" id="card-login">
                    <div class="card-header text-center">
                        <h4>Credenciamento</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input id="nome" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="sobrenome">Sobrenome</label>
                                    <input id="sobrenome" type="text" class="form-control @error('sobrenome') is-invalid @enderror" name="sobrenome" value="{{ old('sobrenome') }}">
        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @foreach ($campos as $campo)    
                            <div class="form-group">
                                <label for="{{ $campo->slug_campo }}" class="@if($campo->fl_obrigatorio == 1) required @endif">{{ $campo->nm_campo }}</label>
                                <input id="{{ $campo->slug_campo }}" type="text" class="form-control @error($campo->slug_campo) is-invalid @enderror" name="{{ $campo->slug_campo }}" value="{{ old($campo->slug_campo) }}">

                                @error($campo->slug_campo)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirmar senha</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <div class="form-check d-flex align-items-center p-0">
                                <input class="form-check-input m-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label ml-4" for="remember">Me lembre</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex flex-column align-items-center justify-content-center bg-transparent">
                        <div class="form-group">
                            <captha-google-component sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" class="mb-2"></captha-google-component>

                            @error('g-recaptcha-response')
                                <div class="alert alert-danger text-center" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success mb-3" style="width: 120px">Registrar</button>
                        <strong class="d-flex align-items-center">Já é inscrito ?<a href="{{ route('login') }}" class="btn btn-link p-0 ml-1">Fazer login</a></strong>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 p-0" id="banner" style="background-image: url({{ asset($evento->lk_banner_auth) }})"></div>
    </div>
</div>
@endsection