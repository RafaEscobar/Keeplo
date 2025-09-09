<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class VahulStoreRequest extends FormRequest
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
            'name' => 'required|string|max:60',
            'description' => 'string|max:230',
            'color' => 'string',
            'user_id' => 'required|integer|exists:users,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre tiene formato incorrecto.',
            'name.max' => 'El nombre es demasiado largo.',
            'description.string' => 'La descripción tiene formato incorrecto.',
            'description.max' => 'La descripción es demasiado larga.',
            'color.string' => 'El color tiene un formato incorrecto.',
            'user_id.required' => 'Falta usuario asociado.',
            'user_id.integer' => 'Formado de usuario asociado incorrecto.',
            'user_id.exists' => 'El usuario no existe.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'La imagen tiene un formato incorrecto',
            'image.mimes' => 'Formato de imagen incorrecto.',
            'image.max' => 'Imagen sumamente pesada',
        ];
    }
}
