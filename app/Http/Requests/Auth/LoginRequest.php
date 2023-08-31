<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:pgsql.Usr.user,email'],
            'password' => ['required', 'string', 'min:6'],
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
            'email' => ':attribute Harus Menggunakan Format Email yang Valid',
            'exists' => ':attribute Tidak Terdaftar Di Catatan Database Kami',
            'min' => ':attribute harus setidaknya mengandung :min Karakter',
            'string' => ':attribute Harus Bertipe Data String',
        ];
    }

}
