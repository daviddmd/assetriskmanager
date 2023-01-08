<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route()->parameter("user");
        return [
            'department' => [Rule::exists("departments", "id"), "nullable"],
            "name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            "active" => [],
            "role" => ["required", new Enum(UserRole::class)],
        ];
    }
}
