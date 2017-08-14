<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateConversacionRequest extends FormRequest
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
          'conversacion' => 'required',
          'mensaje' => 'required'
        ];
    }

    public function messages() {
      return [
        'conversacion.required' => 'Lo siento. Debes escribir un titulo de tu duda.',
        'mensaje.required' => 'Lo siento. Debes escribir un mensaje.'
      ];
    }

}
