<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
       
        return [
            'error_code_ce_id' => 'required',
            'user_id' => 'required',
            'nilai' => ['required','numeric'],
            'comment' => 'nullable'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->getMessageBag()
        ], 422));
    }

    public function messages()
    {
        return [
            'error_code_ce_id.required' => 'error code unknown',
            'user_id.required' => 'user id required',
            'nilai.required' => 'berikan rating',
           
        ];
    }
}
