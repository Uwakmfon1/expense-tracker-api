<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalRequests extends FormRequest
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
            'user_id'=>'required',
            'name'=>'nullable|string|max:255',
            'description'=>'nullable|string',
            'target_amount'=>'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'current_amount'=>'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'deadline'=>'nullable|string|max:255',
            'priority'=>'sometimes|in:low,medium,high',
            'status'=>'sometimes|in:pending,in-process,completed',
        ];
    }
}
