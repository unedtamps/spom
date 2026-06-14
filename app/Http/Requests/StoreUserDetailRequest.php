<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:8|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:255',
            'username' => 'required|unique:users|regex:/^[^\s]+$/',
        ];
    }
}
