<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string', 'max:255'],
            'skills' => ['required', 'string'],
            'linkedin' => ['required', 'string'],
            'github' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'category' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'profile_photo' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:204800'],
        ];
    }
}
