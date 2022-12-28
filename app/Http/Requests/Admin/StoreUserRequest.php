<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {

        return [
            'email'      => ['required', 'email'],
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'role'       => ['required', 'string', new Enum(UserRole::class)],
            'password'   => ['required', 'min:8'],
        ];
    }
}
