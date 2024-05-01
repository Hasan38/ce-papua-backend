<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreTutorialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }
    //user_id','machine_type','customer','type','title','content','link'
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'machine_type' => 'required',
            'customer' => 'required',
            'type' => 'required',
            'title' => ['required','max:255','min:5'],
            'content' => 'nullable',
            'link' => 'nullable',
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
            'user_id.required' => 'user tidak diketahui',
            'machine_type.required' => 'masukan type mesin',
            'customer.required' => 'Pilih none jika tidak ada',
            'title.required' => 'judul tidak boleh kosong',
            'title.min' => 'title/judul min 5 karakter',
            'title.max' => 'title/judul max 255 karakter',
        ];
    }
}
