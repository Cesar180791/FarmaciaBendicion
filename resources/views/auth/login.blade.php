@extends('layouts.app')

@section('content')
<div class="form-container">
        <div class="form-form">            
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h2>
						<a class="navbar-brand text-dark" href="{{ url('/login') }}">
                            <b>{{ config('app.name', 'Laravel') }} <img src="{{ asset('assets/img/mangonegro.png') }}" width="30" height="30"class="navbar-logo" alt="logo"></b>
						</a>
						</h2>
						
                        <form class="text-left" method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user text-dark"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="email" name="email" type="email" placeholder="Correo" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock text-dark"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                                </div>
                                
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block text-dark">Mostrar Contraseña</p>
                                        <label class="switch s-dark">
                                            <input type="checkbox"  onclick="mostrarContrasena()" class="d-none">
                                            <span class="slider round" ></span>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-dark offset-md-1">
                                        {{ __('Iniciar') }}
                                    </button>
                                </div>
                
                            </div>
                        </form>                       
                    </div>                    
                </div>
            </div>
          </div>
         <div class="form-image p-5 m-5" style="text-align:center"><br><br><br><br>
            <img src="{{ asset('assets/img/logo.png') }}" width="750" height="400"class="navbar-logo img-fluid rounded" alt="logo">
        </div>
    </div>
    <style>
        .form-image {
    width:60%!important;
}

body {

    background: #F4F6F6!important;
}
    </style>
    @endsection
