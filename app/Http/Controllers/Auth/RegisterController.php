<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\Brgy;
use App\City;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerification;
use App\Providers\RouteServiceProvider;
use App\Province;
use App\Tourist;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         $tourist = Tourist::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'contact' => $data['contact'],
            'sex' => $data['sex'],
            'token' => base64_encode($data['email']),
            'password' => Hash::make($data['password']),
        ]);

         $address = new Address();
         $address->status = 1;
         $address->user_id = $tourist->id;
         $address->prov_id = $data['province'];
         $address->city_id = $data['city'];
         $address->brgy_id = $data['brgy'];
         $address->address = 'Philippines';
         $address->save();

        $this->dispatch(new SendEmailVerification($tourist));

         return $tourist;
    }

    public function showRegistrationForm()
    {
        $province = Province::all();

        return view('auth.register', compact('province'));
    }

}
