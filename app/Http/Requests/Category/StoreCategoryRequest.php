<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            "name" => "required|string|unique:categories,name",
            "description" => "required|string"
        ];
    }


    public function messages(): array
    {
        return [
            "name.required" => "El campo nombre es obligatorio",
            "name.unique" => "El nombre ya esta registrado",
            "name.string" => "El nombre debe ser un texto",
            "description.required" => "El campo descripcion el obligatorio",
            "description.string" => "La descripcion debe ser un texto",
        ];
    }
}
