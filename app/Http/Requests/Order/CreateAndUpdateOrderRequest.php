<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateAndUpdateOrderRequest extends FormRequest
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
            'produk_id.*' => ['required', 'exists:produk,id'],
            'jumlah.*' => ['required', 'min:0', 'numeric'],
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
            'exists' => ':attribute Tidak Terdaftar Di Catatan Database Kami',
            'min' => ':attribute harus setidaknya mengandung :min Karakter',
            'numeric' => ':attribute harus berformat numeric',
        ];
    }
}
