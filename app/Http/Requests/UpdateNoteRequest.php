<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateNoteRequest extends FormRequest
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
            'machine_id' => 'required',
            'user_id' => 'required',
            'title' => ['required','max:255','min:5'],
            'content' => 'required',
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
            'machine_id.required' => 'mesin tidak diketahui',
            'user_id.required' => 'user tidak diketahui',
            'title.required' => 'judul tidak boleh kosong',
            'title.min' => 'title/judul min 5 karakter',
            'title.max' => 'title/judul max 255 karakter',
            'content.required' => 'content tidak boleh kosong'
        ];
    }
}
