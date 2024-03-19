<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
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
