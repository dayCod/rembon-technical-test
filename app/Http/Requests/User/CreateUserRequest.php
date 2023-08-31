<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'nama_depan' => ['required', 'max:30', 'string'],
            'nama_belakang' => ['required', 'max:30', 'string'],
            'email' => ['required', 'email', 'unique:pgsql,Usr,user,email'],
            'password' => ['required', 'string', 'min:6'],
            'nomor_hp' => ['required', 'regex:/\(?(?:\+62|62|0)(?:\d{2,3})?\)?[ .-]?\d{2,4}[ .-]?\d{2,4}[ .-]?\d{2,4}/', 'min:9', 'max:15'],
            'role' => ['required'],
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
            'email' => ':attribute Harus Menggunakan Format Email yang Valid',
            'min' => ':attribute harus setidaknya mengandung :min Karakter',
            'unique' => ':attribute Sudah Terdaftar',
            'regex' => ':attrbute Harus Berformat Nomor Indonesia yang Valid',
        ];
    }
}
