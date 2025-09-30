<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
        $method = $this->method();
        $rules = [];
        if ($method == 'PUT') {
            $rules = [
                'name' => 'required|string|max:60',
                'status' => 'integer|in:0,1,2',
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:7000',
                'observation' => 'string|max:230|nullable',
                'vahul_id' => 'required|integer|exists:vahuls,id',
                'amount' => 'integer|nullable'
            ];
        } else if($method == 'PATCH') {
            $rules = [
                'name' => 'sometimes|required|string|max:60',
                'status' => 'integer|in:0,1,2',
                'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,webp|max:7000',
                'observation' => 'string|max:230',
                'vahul_id' => 'sometimes|required|integer|exists:vahuls,id',
                'amount' => 'sometimes|integer'
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre tiene un formato incorrecto.',
            'name.max' => 'El nombre es demasiado largo.',
            'status.integer' => 'El formato del estatus es incorrecto.',
            'status.in' => 'El estatus proporcionado es incorrecto.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'La imagen tiene un formato incorrecto.',
            'image.mimes' => 'El formato de la imagen es incorrecto.',
            'image.max' => 'La imagen es demasiado pesada.',
            'observation.string' => 'Las observaciones tienen un formato incorrecto.',
            'observation.max' => 'Reduce la longitud de las observaciones.',
            'vahul_id.required' => 'El vahul asociado es obligatorio.',
            'vahul_id.integer' => 'El vahul tiene un formato incorrecto.',
            'vahul_id.exists' => 'El vahul asociado no existe.',
            'amount.integer' => 'La cantidad tiene el formato incorrecto.'
        ];
    }
}
