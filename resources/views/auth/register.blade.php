@extends('layouts.app')

@section('js')
    <script src="{{ asset(mix('js/in-tourist.js')) }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col l8 m8 s12 offset-l2 offset-m2">
            <div class="card">
                <div class="card-content">
                    <h5 class="center">Tourist Registration</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col l6 m12 s12">
                                <div class="row">
                                    <h6><b>Personal Information</b></h6>
                                    <div class="input-field col s12">
                                        <input id="surname" type="text" name="lastname" class="validate" value="{{ old('lastname') }}" required/>
                                        <label for="surname">LastName</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="firstname" type="text" name="firstname" value="{{ old('firstname')}}" class="validate"/>
                                        <label for="firstname">Firstname</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="middlename" type="text" name="middlename" value="{{ old('middlename')}}" class="validate" required/>
                                        <label for="middlename">Middlename</label>
                                        <div class="divider"></div>
                                    </div>

                                    {{--<div class="input-field col s12">--}}
                                        {{--<textarea id="textarea1" class="materialize-textarea" name="address" required>{{ old('address')}}</textarea>--}}
                                        {{--<label for="textarea1">Address</label>--}}
                                    {{--</div>--}}
                                    <div class="col s12">
                                        <label>Province</label>
                                        <select class="browser-default" @change="getCity" v-model="provReg"  name="province">
                                            <option :value="0" disabled>--Select province--</option>
                                            @foreach($province as $p)
                                                <option value="{{ $p->provCode }}">{{ $p->provDesc }}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col s12">
                                        <label>City/Municipality</label>
                                        <select class="browser-default" @change="getBrgy" v-model="cityReg"  name="city">
                                            <option :value="0" disabled>--Select Municipality/City--</option>
                                            <option v-for="c in cities" :value="c.citymunCode">@{{ c.citymunDesc}}</option>
                                        </select>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col s12">
                                        <label>Barangay</label>
                                        <select class="browser-default" v-model="brgyReg" name="brgy">
                                            <option :value="0" disabled>--Select Barangay--</option>
                                            <option v-for="b in brgys" :value="b.brgyCode">@{{ b.brgyDesc}}</option>
                                        </select>
                                        @error('brgy')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="contact" type="text" name="contact"  value="{{ old('contact')}}" class="validate"/>
                                        <label for="contact">Contact Number</label>
                                    </div>
                                    <div class="input-field col s12 row">
                                        <b>Sex:</b><br>
                                        <div class="col s4">
                                            <label>
                                                <input name="sex" value="1" type="radio" required/>
                                                <span>Male</span>
                                            </label>
                                        </div>
                                        <div class="col s4">
                                            <label>
                                                <input name="sex" value="0" type="radio" required/>
                                                <span>Female</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l6 m12 s12">
                                <div class="row">
                                    <h6><b>Account Information</b></h6>

                                    <div class="input-field col s12">
                                        <input id="email" type="email" name="email" class="validate"  value="{{ old('email')}}" required autocomplete="email"/>
                                        <label for="email">Email</label>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="username" type="text" name="username" class="validate" value="{{ old('username')}}" required autocomplete="username"/>
                                        <label for="username">Username</label>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="password" type="password" name="password" class="validate" required/>
                                        <label for="password">Password</label>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="password-confirm" type="password" name="password_confirmation" class="validate" required/>
                                        <label for="password-confirm">Confirm Password</label>
                                    </div>

                                    <div class="input-field col s12 center">
                                        <button class="btn blue darken-2" type="submit">Register</button>
                                        <a href="/" class="btn btn-flat" >cancel</a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
