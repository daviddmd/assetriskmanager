<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermanentContactPointRequest extends FormRequest
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
            "entity_name"=>["required"],
            "permanent_contact_point_name"=>["required"],
            "main_email_address"=>["required"],
            "secondary_email_address"=>["required"],
            "main_landline_phone_number"=>["required"],
            "secondary_landline_phone_number"=>["required"],
            "main_mobile_phone_number"=>["required"],
            "secondary_mobile_phone_number"=>["required"],
            "other_alternative_contacts"=>[],
        ];
    }
}
