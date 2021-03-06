<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Providers\RouteServiceProvider;
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'phone' => ['integer'],
        ],
        [
            'name.required' => 'Falta poner el nombre',
            'surname.required' => 'Falta poner el apellido',
            'email.unique' => 'Este email ya está registrado',
            'password.required' => 'Falta la contraseña',
            'password.min' => 'El minimo para la contraseña son 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'phone.integer' => 'En el teléfono solo van números'
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
        return
            User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'active' => 1,
                'roles_id' => 2,
        ]);
        
    }
    public function emailCheck($email) {
        $user = array(User::where('email', $email)->exists());
        
          return response(json_encode($user)); 
    }
    
}
