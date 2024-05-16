<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'area_id' => 'required',
            'title' => 'required',
            'remarks' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
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
            'area_id.required' => 'area tidak boleh kosong',
            'title.required' => 'title tidak boleh kosong',
            'start_date.required' => 'start date tidak boleh kosong',
            'end_date.required' => 'end date tidak boleh kosong',
        ];
    }
}



