@extends('layouts.app')

@section('js')
    <script src="{{ asset(mix('js/in-tourist.js')) }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col l8 m6 s12">
            <div align="center">
                <h1 class="white-text scs">Image</h1>
            </div>
        </div>
        <div class="col l4 m6 s12">
            <div class="card">
                <div class="card-content">
                    <h5>Login</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="text" class="validate" value="{{ old('email') }}" required autocomplete="email"/>
                                <label for="email">Email/Username</label>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s12">
                                <input id="password" type="password" name="password" class="validate"  required>
                                <label for="password">Password</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>
                                        {{ __('Remember Me') }}
                                        </span>
                            </label>
                        </div>

                        <div align="center">
                            <button type="submit" class="btn blue darken-3 waves-effect">
                                {{ __('Login') }}
                            </button>
                            <br>
                            <br>
                            @if (Route::has('password.request'))
                                <a class="blue-text text-darken-2" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <br>Not Tourist Account Yet?<a class="blue-text text-darken-2" href="{{ route('register') }}">
                                Register Here.
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
