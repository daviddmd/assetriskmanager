<?php

namespace App\Http\Requests;

use App\Enums\ManufacturerContractType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateAssetRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        $asset = $this->route()->parameter("asset");
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
            "availability_appreciation" => ["numeric", "min:1", "max:5"],
            "integrity_appreciation" => ["numeric", "min:1", "max:5"],
            "confidentiality_appreciation" => ["numeric", "min:1", "max:5"],
            "export" => [],
            "active" => [],
            "links_to" => [
                Rule::exists("assets", "id"),
                "nullable",
                Rule::notIn(
                    array_merge(
                        [$asset->id],
                        $asset->children()->pluck("id")->toArray()
                    )
                )
            ]
        ];
    }
}
