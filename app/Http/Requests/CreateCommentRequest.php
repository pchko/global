<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCommentRequest extends FormRequest
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
            'owner' => 'required|string',
            'comment' => 'required|string',
            'idArticle' => 'required|exists:articles,idArticle'
        ];
    }

    public function messages(){
        return [
            'owner.required' => 'Ingrese un propietario del artículo',
            'owner.string' => 'Ingrese un propietario del artículo válido',
            'comment.required' => 'Ingrese un texto para el artículo',
            'comment.string' => 'Ingrese un texto válido para el artículo',
            'idArticle.required' => 'Ingrese un ID Articulo',
            'idArticle.exists' => 'Ingrese un ID Articulo válido'
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
