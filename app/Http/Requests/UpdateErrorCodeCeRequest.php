<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateErrorCodeCeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'error_code' => 'required',
            'machine_type' => 'required',
            'problem_info' => 'required',
            'action_taken' => 'required',
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
            'user_id.required' => 'user unknown',
            'error_code.required' => 'error code tidak boleh kosong',
            'machine_type.required' => 'type mesin tidak boleh kosong',
            'problem_info.required' => 'problem info tidak boleh kosong',
            'action_taken.required' => 'action tidak boleh kosong',
        ];
    }
}
