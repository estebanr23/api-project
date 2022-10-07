<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersona extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:personas,dni, '. $this->persona->id,
            // 'dni' => ['required', Rule::unique('personas', 'dni')->ignore($this->persona)],
            'email' => 'required',
            'telefono' => 'required'
        ];
    }
}
