@extends('layouts.admin')

@section('content2')
    <div class="container" style="padding-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <h4 class="text-center">Login</h4>
                        <form method="POST" action="{{ route('adminLogin') }}" aria-label="{{ __('Login') }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="email" class="col-sm-12 col-form-label">Email/Username</label>

                                <div class="col-md-12">
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div align="center">
                                <button type="submit" class="btn btn-primary">
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
