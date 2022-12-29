<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSecurityOfficerRequest extends FormRequest
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
        return [
            "entity_name" => ["required"],
            "name" => ["required"],
            "role" => ["required"],
            "email_address" => ["required", "email:rfc"],
            "landline_phone_number" => ["required"],
            "mobile_phone_number" => ["required"]
        ];
    }
}
