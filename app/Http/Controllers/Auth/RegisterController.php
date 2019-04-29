<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Mail\userRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect('/login');
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $profile = new Profile();
        $profile->name = $data['name'];

        $user = new User();
        $user->email    = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->token    = str_random(20);

        $user->save();
        $profile->user()->associate($user);
        $profile->save();

        
        Mail::to($user->email)->send(new userRegistered($user));
    }


    public function verify_register($token, $id)
    {
        $user = User::find($id);

        if(!$user){
            return redirect('login')->with('warning', 'User tidak ditemukan!');
        }

        if($user->token != $token){
            return redirect('login')->with('warning', 'Token tidak cocok!');
        }

        $user->status = 1;
        $user->save();

        $this->guard()->login($user);
        return redirect('/home');
    }
}
