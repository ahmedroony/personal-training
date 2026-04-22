<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StoreCaptainRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20|unique:phones,number',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً، يرجى اختيار بريد آخر.',
            'phone_number.unique' => 'رقم الهاتف مسجل مسبقاً، يرجى اختيار رقم آخر.',
        ];
    }
}
