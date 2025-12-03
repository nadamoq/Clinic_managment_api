<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'gender'=>'required|string|in:female,male',
            'birth'=>'required|date_format:Y-m-d',
            'mobile' => ['required', 'regex:/^(?:\+970|0)(59|56)\d{7}$/'],
            'supervisor_id'=>'required|exists:supervisors,id',
           
        ];
    }
}
