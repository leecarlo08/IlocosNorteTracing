@extends('layouts.app')

@section('js')
    <script src="{{ asset(mix('js/in-spot.js')) }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l4 m6 s12 offset-l4 offset-l3">
                <div class="card">
                    <div class="card-content">
                        <h5>Login</h5>
                        <form method="POST" action="/site-officer/login">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
