<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user->isStudent()||auth()->user->isAdmin();
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
            'gender'=>'required|in:male,female',
            'birth'=>'required|date_format:Y-m-d',
            'mobile'=>['required', 'regex:/^(?:\+970|0)(59|56)\d{7}$/'],
            'supervisor_id'=>'required|exists:supervisors,id',
        

        ];
    }
}
