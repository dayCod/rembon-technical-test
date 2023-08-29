<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateAndUpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'max:100', 'string'],
            'brand' => ['required', 'max:40', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute Tidak Boleh Kosong',
            'max' => ':attribute Tidak Boleh Melebihi :max Karakter',
            'string' => ':attribute Harus Bertipe Data String',
            'min' => ':attribute harus setidaknya mengandung :min Karakter',
            'numeric' => ':attribute harus berformat numeric',
        ];
    }
}
