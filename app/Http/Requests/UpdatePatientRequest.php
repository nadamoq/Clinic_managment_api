<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  ($this->user()->isReceptionist()||$this->user()->isAdmin());
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
            'email'=>'sometimes|email',
            'birth'=>'sometimes|date_format:Y-m-d',
            'diabetes'=>'sometimes',
            'gender'=>'sometimes|in:male,female',
            'Blood_type'=>'sometimes|alpha|in:A,B,AB,O',
            'procedure_id'=>'sometimes|exists:procedures,id',
            'image'=>'nullable|mimes:png,jpg|max:2024'
        ];
    }
}
