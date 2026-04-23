<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20|unique:phones,number',
            'starts_at' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:starts_at',
            'plan_id' => 'nullable|exists:plans,id',
            'name_plan' => 'required_without:plan_id|nullable|string|max:255',
            'duration' => 'required_without:plan_id|nullable|integer',
            'price' => 'nullable|numeric|min:0',
        ];
    }
}
