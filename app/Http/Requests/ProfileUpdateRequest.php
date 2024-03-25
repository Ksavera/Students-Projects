<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'last_name' => ['nullable', 'string', 'max:255'],
            'about' => ['nullable', 'string', 'max:255'],
            'skills' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'string'],
            'github' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'category' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:204800'],
        ];
    }
}
