<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transaction extends FormRequest
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

            'keterangan' => '',
            'donatur_id' => 'required',
            'nominal' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'donatur_id' => 'Kode Donatur',
        ];
    }
}
