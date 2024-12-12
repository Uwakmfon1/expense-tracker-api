<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetRequest extends FormRequest
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
            'category_id' => 'required|numeric|min:0|max:255',
            'user_id' => 'exists:App\Models\User,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date',
        ];
    }
}
