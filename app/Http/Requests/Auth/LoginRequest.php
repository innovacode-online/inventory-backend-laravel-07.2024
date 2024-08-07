<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|email|exists:users,email",
            "password" => "required|min:6",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "El correo es obligatorio",
            "email.email" => "El correo electronico no es valido",
            "email.exists" => "No se encontro el correo",
            "password.required" => "La contraseña es obligatoria",
            "password.min" => "La contraseña debe tener mas de 6 catacteres"
        ];
    }
}
