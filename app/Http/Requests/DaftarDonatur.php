<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DaftarDonatur extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'nama' => 'required',
            'nama_outlet' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'jenkel' => 'required:in:L,P',
            'kode' => 'required|alpha_num|min:5',Rule::unique('kode')->ignore($this->donatur),
            'map' => '',
            'status' => '',
        ];
    }

    public function messages(): array
    {
        return [
            'jenkel.required' => 'Jenis Kelamin harus dipilih',
            'no_hp.required' => 'Nomor Whatsapp harus diisi',
        ];
    }

    public function attributes(): array
    {
        return [
            'no_hp' => 'No Handphone',
        ];
    }
}
