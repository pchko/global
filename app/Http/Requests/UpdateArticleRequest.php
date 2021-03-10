<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateArticleRequest extends FormRequest
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
            //
            'owner' => 'string',
            'article' => 'string',
            'photo' => 'string'
        ];
    }

    public function messages(){
        return [
            'owner.string' => 'Ingrese un propietario del artículo válido',
            'article.string' => 'Ingrese un texto válido para el artículo',
            'photo.required' => 'Ingrese un valor válido para la foto'

        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'code' => 0,
                'errors' => $validator->errors()
            ], 400)
        );
    }
}
