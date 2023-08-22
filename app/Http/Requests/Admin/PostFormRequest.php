<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostFormRequest extends FormRequest
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
            'title' => [
                'required',
                Rule::unique('posts')->ignore($this->route()?->parameter('post') ?: null),
                'min:6'
            ],
            'slug' => [
                'required_unless:title,null',
                Rule::unique('posts')->ignore($this->route()?->parameter('post') ?: null),
                'min:6',
                'regex:/^[a-z0-9\-]+$/'
            ],
            'content' => ['required', 'min:100'],
            'categories' => ['required', 'array', 'exists:categories,id']
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
           'slug' => $this->input('slug') ?: Str::slug($this->input('title'))
        ]);
    }
}
