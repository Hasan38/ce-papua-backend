<?php

namespace App\Http\Requests;

use App\Models\AreaGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateAreaGroupRequest extends FormRequest
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
            'regional_id' => 'required',
            'name' => ['required', Rule::unique('area_groups','name')->ignore($this->id)],
            'lat' => 'nullable',
            'long' => 'nullable'
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
            'regional_id.required' => 'regional tidak boleh kosong',
            'name.required' => 'nama area tidak boleh kosong',
            'name.unique' => 'area sudah terdaftar',
        ];
    }

}
