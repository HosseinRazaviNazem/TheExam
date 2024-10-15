<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'task_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:Low,Medium,High',
            'status' => 'required|string|in:Pending,In Progress,Completed',
            'deadline' => 'required|date',
        ];
    }
}
