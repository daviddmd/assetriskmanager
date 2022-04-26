<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Create Asset")}}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('assets.store')}}">
                        @csrf
                        <div class="mb-6">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                            <input type="text" id="name" name="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{old("username")}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Description")}}</label>
                            <textarea name="description" id="description"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{old("description")}}</textarea>
                        </div>
                        <div class="mb-6">
                            <label for="type"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Asset Type")}}</label>
                            <select name="type" id="type"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    required>
                                @foreach($assetTypes as $assetType)
                                    <option
                                        {{old("type") == $assetType->id ? "selected" : ""}}
                                        value="{{ $assetType->id }}">
                                        {{ $assetType->name  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="manager"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manager")}}</label>
                            <select name="manager" id="manager"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    required>
                                @foreach($users as $user)
                                    <option
                                        {{old("manager") == $user->id ? "selected" : ""}}
                                        value="{{ $user->id }}">
                                        {{ "$user->name:$user->email" }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="sku"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("SKU/Inventory ID")}}</label>
                            <input type="text" id="sku" name="sku"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{old("sku")}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="manufacturer"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer")}}</label>
                            <input type="text" id="manufacturer" name="manufacturer"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{old("manufacturer")}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="location"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Location")}}</label>
                            <input type="text" id="location" name="location"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{old("location")}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="manufacturer_contract_type"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Type")}}</label>
                            <select name="manufacturer_contract_type" id="manufacturer_contract_type"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    required>
                                @foreach(\App\Enums\ManufacturerContractType::cases() as $role)
                                    <option
                                        {{old("manufacturer_contract_type") == $role->value ? "selected" : ""}}
                                        value="{{ $role->value }}" {{ $role == \App\Enums\ManufacturerContractType::NONE && empty(old("manufacturer_contract_type"))  ? "selected" : "" }}>
                                        {{ __("enums.".$role->name)  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="hidden" id="contract_details">
                            <div class="mb-6">
                                <label for="manufacturer_contract_provider"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Provider")}}</label>
                                <input type="text" id="manufacturer_contract_provider"
                                       name="manufacturer_contract_provider"
                                       value="{{old("manufacturer_contract_provider")}}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label for="contract_date_range_picker"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Date")}}</label>
                                <div date-rangepicker class="flex items-center" id="contract_date_range_picker">
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input name="manufacturer_contract_beginning_date"
                                               id="manufacturer_contract_beginning_date" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{old("manufacturer_contract_beginning_date")}}"
                                               placeholder="{{__('Contract Starting Date')}}">
                                    </div>
                                    <span class="mx-4 text-gray-500">{{__("to")}}</span>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input name="manufacturer_contract_ending_date"
                                               id="manufacturer_contract_ending_date" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{old("manufacturer_contract_ending_date")}}"
                                               placeholder="{{__('Contract Ending Date')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="mac_address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("MAC Address")}}</label>
                            <input type="text" id="mac_address" name="mac_address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{old("mac_address")}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="ip_address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("IP Address")}}</label>
                            <input type="text" id="ip_address" name="ip_address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{old("ip_address")}}"
                                   required>
                        </div>
                        <div class="mb-6 flex">
                            <label for="availability_appreciation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Availability Appreciation")}}</label>
                            <input type="number" id="availability_appreciation" name="availability_appreciation"
                                   min="1" max="5"
                                   value="{{empty(old("availability_appreciation")) ? 1 : old("availability_appreciation")}}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>
                            <label for="integrity_appreciation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Integrity Appreciation")}}</label>
                            <input type="number" id="integrity_appreciation" name="integrity_appreciation"
                                   min="1" max="5"
                                   value="{{empty(old("integrity_appreciation")) ? 1 : old("integrity_appreciation")}}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>
                            <label for="confidentiality_appreciation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Confidentiality Appreciation")}}</label>
                            <input type="number" id="confidentiality_appreciation" name="confidentiality_appreciation"
                                   min="1" max="5"
                                   value="{{empty(old("confidentiality_appreciation")) ? 1 : old("confidentiality_appreciation")}}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="export"
                                   class="form-check-label inline-block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Export to CNCS?")}}</label>
                            <input
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="checkbox" value="{{old("export")}}" name="export" id="export">
                        </div>
                        <div class="mb-6">
                            <label for="links_to"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Links To Asset")}}</label>
                            <select name="links_to" id="links_to"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option selected value="">{{"None"}}</option>
                                @foreach($assets as $asset)
                                    <option
                                        {{old("links_to") == $asset->id ? "selected" : ""}}
                                        value="{{ $asset->id }}">
                                        {{ "$asset->id:$asset->name" }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Create")}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    let select = document.getElementById("role");
    select.onchange = function () {
        if (select.value !== "{{\App\Enums\ManufacturerContractType::NONE->value}}") {
            document.getElementById("contract_details").classList.remove("hidden");
        } else {
            document.getElementById("contract_details").classList.add("hidden");
            document.getElementById("manufacturer_contract_provider").value = "";
            document.getElementById("manufacturer_contract_beginning_date").value = "";
            document.getElementById("manufacturer_contract_ending_date").value = "";


        }
    }
</script>
