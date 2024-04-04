<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'area_id' => 'required',
            'name' => ['required','max:100'],
            'email'=> ['required','unique:users','max:100'],
            'nip'=> ['required','unique:users','max:10'],
            'password' => ['required','max:50'],
            'phone' => ['required','max:12','min:10','unique:users'],
            'address' => ['required','max:150'],
            'avatar' => 'nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'area_id.required' => 'area group tidak boleh kosong',
            'name.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'email.unique' => 'email telah terdaftar',
            'email.max' => 'email maximal 100 karakter',
            'nip.required' => 'nip tidak boleh kosong',
            'nip.unique' => 'nip telah terdaftar',
            'nip.max' => 'nip maximal 10 karakter',
            'password.required' => 'password tidak boleh kosong',
            'password.max' => 'password maximal 50 karakter',
            'phone.required' => 'phone number tidak boleh kosong',
            'phone.unique' => 'phone number telah terdaftar',
            'phone.max' => 'nip maximal 12 karakter',
            'phone.min' => 'nip minimal 10 karakter',
            'address.required' => 'alamat tidak boleh kosong',
            'address.max' => 'alamat maximal 150 karakter',
        ];
    }
}
