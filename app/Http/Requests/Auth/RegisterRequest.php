<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|max:16|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre tiene un formato incorrecto.',
            'name.max' => 'El nombre es demasiado largo.',
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.string' => 'El apellido tiene un formato incorrecto.',
            'last_name.max' => 'El apellido es demasiado largo.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico tiene un formato incorrecto.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.max' => 'La contraseña debe tener máximo 16 caracteres.',
            'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',
        ];
    }
}
