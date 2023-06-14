@extends('layouts.sesion')
@section('title',':: ARROW Inicio de sesión ::')
@section('contenido')

<div class="container" style="display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;">
   
  <nav class="navbar navbar-expand-lg navbar-dark stroke">
    
      <a class="navbar-brand" href="index.html">
      <img src="{{asset('images/ARROW.png')}}"  class="rounded-circle img-" width="250px" height="190px"><br>
                               
      </a>
    </h1>
  </nav>
  <div class="login-top">
    <form method="POST" action="{{ route('login') }}" style="width:400px;">
      @csrf
      <div class="login-ic">
      <!-- <i class="zmdi zmdi-email"></i> -->
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Electrónico" >
            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="clear"></div>
      </div>

      <div class="login-ic">
        <!-- <i class="zmdi zmdi-lock"></i> -->
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="clear"></div>
      </div>

      <div class="log-bwn">
        <button type="submit" value="Iniciar sesión">
          {{ __('Iniciar sesión') }}
        </button>
      </div>

      <!-- <div class="login-ic">
        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
        <label for="rememberme" class="login-label">Recordar</label>
      </div> -->

      <div class="text-center">
        <a href="{{ route('register') }}" class="btn btn-raised waves-effect">Registrarse</a>
        @if (Route::has('password.request'))
        <a class="btn btn-link" style="color:#fff;" href="{{ route('password.request') }}">
          {{ __('¿Olvidaste tu contraseña?') }}
        </a>
        @endif
      </div>
    </form>
  </div>
</div>


</div>
@endsection
