<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatedUser extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:45'],
            'surname' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['integer'],
            'role' => ['required', 'integer']
        ];
    }
    public function messages()
    {
        return [
            'password.min' => 'La contraseña necesita 8 caracteres mínimo.',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'role.required' => 'Hay que asignarle un rol al usuario',
            'email.unique' => 'Ese email ya está registrado'
        ];
    }

    
}
