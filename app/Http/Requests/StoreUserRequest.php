<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            //
            'name'=>'required|string|min:3',
            'email'=>'required|unique:users,email|email',
            'password'=>['required','confirmed','string',Password::min(3)->max(40)->letters()->symbols()->uncompromised()],
            'role'=>'required|string|in:admin,supervisor,student,receptionist'
        ];
    }
}
