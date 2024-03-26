<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePullRequestRequest extends FormRequest
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
            'title' => 'required|string|max:55',
            'owner' => 'required|string|max:55',
            'repo_name' => 'required|string|max:55',
            
        ];
    }
}
