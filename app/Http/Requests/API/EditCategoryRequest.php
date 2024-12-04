<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'name'=>'sometimes|string|max:255',
            'type'=>'sometimes|in:Expense,Income',
            'description'=>'sometimes|string',
            'image_url'=>'sometimes|string',
        ];
    }
}
