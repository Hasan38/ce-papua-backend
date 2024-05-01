<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateMachineRequest extends FormRequest
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
            'terminal_id' => 'required',
            'customer_id' => ['required','numeric'],
            'customer_type' => 'required',
            'area_id' => ['required','numeric'],
            'branch' => 'required',
            'sn' => ['required', Rule::unique('machines','sn')->ignore($this->id)],
            'machine_type' => 'required',
            'address' => 'required',
            'zona' => ['required','numeric'],
            'service_status' => 'required',
            'pengelola' => 'required',
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
            'terminal_id.required' => 'terminal id/wsid/tid tidak boleh kosong',
            'customer_id.required' => 'customer tidak boleh kosong',
            'customer_id.numeric' => 'customer id harus format numeric',
            'customer_type.required' => 'customer type tidak boleh kosong',
            'area_id.required' => 'area group tidak boleh kosong',
            'area_id.numeric' => 'area group id harus format numeric',
            'branch.required' => 'branch tidak boleh kosong',
            'sn.required' => 'SN tidak boleh kosong',
            'sn.unique' => 'SN sudah terdaftar',
            'machine_type.required' => 'machine type tidak boleh kosong' ,
            'address.required' => 'alamat mesin tidak boleh kosong',
            'zona.required' => 'zona mesin tidak boleh kosong',
            'zona.numeric' => 'zona di isi dengan angka saja',
            'service_status.required' => 'service status tidak boleh kosong',
            'pengelola.required' => 'pengelola tidak boleh kosong',
        ];
    }
}


