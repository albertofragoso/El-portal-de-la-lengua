<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticuloRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => 'required',
            'articulo' => 'required',
            'imagen' => 'required'
        ];
    }

    public function messages() {
      return [
        'titulo.required' => 'Lo siento. Debes ingresar un título.',
        'articulo.required' => 'Lo siento. Debes ingresar un contenido.',
        'imagen.required' => 'Lo siento. Debes subir una imagen.'
      ];
    }
}
