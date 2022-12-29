<?php

namespace App\Http\Requests;

use App\Enums\ManufacturerContractType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreAssetRequest extends FormRequest
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
            "name" => ["required"],
            "type" => [Rule::exists("asset_types", "id"), "required"],
            "manager" => [Rule::exists("users", "id"), "required"],
            "description" => ["required"],
            "sku" => ["required"],
            "manufacturer" => ["required"],
            "location" => ["required"],
            "manufacturer_contract_type" => ["required", new Enum(ManufacturerContractType::class)],
            "manufacturer_beginning_date" => ["date", "nullable"],
            "manufacturer_ending_date" => ["date", "nullable"],
            "manufacturer_contract_provider" => ["nullable"],
            "mac_address" => ["nullable"],
            "ip_address" => ["nullable"],
            "export" => [],
            "links_to" => [Rule::exists("assets", "id"), "nullable"]
        ];
    }
}
