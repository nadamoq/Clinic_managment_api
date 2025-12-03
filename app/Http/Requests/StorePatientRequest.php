<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            
            'name'=>'required|string|min:3',
            'email'=>'required|email',
            'birth'=>'required',
            'diabetes'=>'required',
            'gender'=>'required|in:male,female',
            'Blood_type'=>'required|alpha|in:A,B,AB,O',
            'procedure_id'=>'required|exists:procedures,id',
            'image'=>'nullable|mimes:png,jpg|max:2024'
            ];
    }
}
