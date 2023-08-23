<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'surname' => ['required', 'string', 'between:2,30'],
            'name' => ['required', 'string', 'between:2,30'],
            'email' => ['required', 'email', 'min:4'],
            'subject' => ['required', 'string', 'between:2,30'],
            'message' => ['required', 'string', 'min:4']
        ];
    }
}
