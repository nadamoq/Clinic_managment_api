<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'name'=>'sometimes|string|min:3',
            'email'=>'sometimes|email|unique:users,email',
            'password'=>['sometimes','confirmed','string',Password::min(3)->max(40)->letters()->symbols()->uncompromised()],
            'role'=>'sometimes|string|in:admin,supervisor,student,receptionist'
        ];
    }
}
