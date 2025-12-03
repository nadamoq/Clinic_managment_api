<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isSupervisor();
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
            'mark'=>'required|numeric|Between:40.0,99.5',
            'appointment_id'=>'required|exists:appointments,id|unique:evaluations,appointment_id',
            'description'=>'nullable|filled|string'
        ];
       


    } 
    public function messages(){
            return [ 
                
                'appointment_id.unique'=>'already evaluated'
            
            ];
        }
}
