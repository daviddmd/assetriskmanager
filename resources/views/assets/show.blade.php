<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Edit Asset")}}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                        <input type="text" id="name" name="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{old("name") ? old("name") : $asset->name}}"
                               required disabled>
                    </div>
                    <div class="mb-6">
                        <label for="description"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Description")}}</label>
                        <textarea name="description" id="description"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  disabled>{{old("description")?old("description"):$asset->description}}</textarea>
                    </div>
                    <div class="mb-6">
                        <label for="type"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Asset Type")}}</label>
                        <select name="type" id="type"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                required disabled>
                            <option
                                value="{{ $asset->type->id }}">
                                {{ $asset->type->name  }}
                            </option>
                        </select>
                    </div>
                    @if(in_array(Auth::user()->role,[\App\Enums\UserRole::SECURITY_OFFICER,\App\Enums\UserRole::DATA_PROTECTION_OFFICER]))
                        <div class="mb-6">
                            <label for="manager"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manager")}}</label>
                            <a href="{{route("users.show",$asset->manager->id)}}" id="manager" target="_blank"
                               class="no-underline hover:underline">{{$asset->manager->name . ":" . $asset->manager->email}}</a>
                        </div>
                    @else
                        <input type="hidden" name="manager" value="{{$asset->manager_id}}">
                    @endif

                    <div class="mb-6">
                        <label for="sku"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("SKU/Inventory ID")}}</label>
                        <input type="text" id="sku" name="sku"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{old("sku") ? old("sku") : $asset->sku}}"
                               required disabled>
                    </div>
                    <div class="mb-6">
                        <label for="manufacturer"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer")}}</label>
                        <input type="text" id="manufacturer" name="manufacturer"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{old("manufacturer") ? old("manufacturer") : $asset->manufacturer}}"
                               required disabled>
                    </div>
                    <div class="mb-6">
                        <label for="location"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Location")}}</label>
                        <input type="text" id="location" name="location"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{old("location") ? old("location") : $asset->location}}"
                               required disabled>
                    </div>
                    <div class="mb-6"
                         x-data="{ visible: {{(!empty(old("manufacturer_contract_type")) && old("manufacturer_contract_type") != \App\Enums\ManufacturerContractType::NONE) || $asset->manufacturer_contract_type != \App\Enums\ManufacturerContractType::NONE ? "true" : "false"}} }">
                        <label for="manufacturer_contract_type"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Type")}}</label>
                        <select name="manufacturer_contract_type" id="manufacturer_contract_type"
                                x-on:change="visible = $event.target.value != '{{\App\Enums\ManufacturerContractType::NONE->value}}'"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                required disabled>
                            @foreach(\App\Enums\ManufacturerContractType::cases() as $role)
                                <option
                                    {{old("manufacturer_contract_type") ? (old("manufacturer_contract_type") == $role->value ? "selected" : "")  : ($asset->manufacturer_contract_type == $role ? "selected" : "")}}
                                    value="{{ $role->value }}">
                                    {{ __("enums.".$role->name)  }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            x-show="visible"
                            id="contract_details">
                            <div class="mb-6">
                                <label for="manufacturer_contract_provider"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Provider")}}</label>
                                <input type="text" id="manufacturer_contract_provider"
                                       name="manufacturer_contract_provider"
                                       value="{{old("manufacturer_contract_provider") ? old("manufacturer_contract_provider") : $asset->manufacturer_contract_provider}}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       disabled>
                            </div>
                            <div class="mb-6">
                                <label for="contract_date_range_picker"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Date")}}</label>
                                <div date-rangepicker datepicker-format="yyyy-mm-dd" class="flex items-center"
                                     id="contract_date_range_picker">
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input name="manufacturer_contract_beginning_date"
                                               disabled
                                               id="manufacturer_contract_beginning_date" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{old("manufacturer_contract_beginning_date") ? old("manufacturer_contract_beginning_date") : $asset->manufacturer_contract_beginning_date}}"
                                               placeholder="{{__('Contract Starting Date')}}">
                                    </div>
                                    <span class="mx-4 text-gray-500">{{__("to")}}</span>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                 fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input name="manufacturer_contract_ending_date"
                                               id="manufacturer_contract_ending_date" type="text"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               value="{{old("manufacturer_contract_ending_date") ? old("manufacturer_contract_ending_date") : $asset->manufacturer_contract_ending_date}}"
                                               placeholder="{{__('Contract Ending Date')}}"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="mac_address"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("MAC Address")}}</label>
                        <input type="text" id="mac_address" name="mac_address"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{old("mac_address") ? old("mac_address") : $asset->mac_address}}"
                               required disabled>
                    </div>
                    <div class="mb-6">
                        <label for="ip_address"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("IP Address")}}</label>
                        <input type="text" id="ip_address" name="ip_address"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{old("ip_address") ? old("ip_address") : $asset->ip_address}}"
                               required disabled>
                    </div>
                    <div class="mb-6">
                        <div class="flex">
                            <label for="availability_appreciation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Availability Appreciation")}}</label>
                            <input type="number" id="availability_appreciation" name="availability_appreciation"
                                   min="1" max="5"
                                   value="{{old("availability_appreciation") ? old("availability_appreciation") : $asset->availability_appreciation }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   style="background-color: {{$asset->color(old("availability_appreciation") ? old("availability_appreciation") : $asset->availability_appreciation)}}"
                                   required disabled>
                            <label for="integrity_appreciation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Integrity Appreciation")}}</label>
                            <input type="number" id="integrity_appreciation" name="integrity_appreciation"
                                   min="1" max="5"
                                   value="{{old("integrity_appreciation") ? old("integrity_appreciation") : $asset->integrity_appreciation }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   style="background-color: {{$asset->color(old("integrity_appreciation") ? old("integrity_appreciation") : $asset->integrity_appreciation)}}"
                                   required disabled>
                            <label for="confidentiality_appreciation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Confidentiality Appreciation")}}</label>
                            <input type="number" id="confidentiality_appreciation"
                                   name="confidentiality_appreciation"
                                   min="1" max="5"
                                   value="{{old("confidentiality_appreciation") ? old("confidentiality_appreciation") : $asset->confidentiality_appreciation }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   style="background-color: {{$asset->color(old("confidentiality_appreciation") ? old("confidentiality_appreciation") : $asset->confidentiality_appreciation)}}"
                                   required disabled>
                        </div>
                        <label for="total_appreciation"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Total Appreciation")}}</label>
                        <input type="number" id="total_appreciation"
                               value="{{$asset->totalAppreciation() }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               style="background-color: {{$asset->color($asset->totalAppreciation())}}"
                               disabled>

                    </div>
                    <div class="mb-6">
                        <label for="export"
                               class="form-check-label inline-block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Export to CNCS?")}}</label>
                        <input
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="checkbox" name="export"
                            id="export"
                            {{!empty(old("export")) ? "checked" : ($asset->export ? "checked" : "")}} disabled>
                    </div>
                    <div class="mb-6">
                        <label for="active"
                               class="form-check-label inline-block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Active?")}}</label>
                        <input
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="checkbox" name="active"
                            id="active"
                            {{!empty(old("active")) ? "checked" : ($asset->active ? "checked" : "")}} disabled>
                    </div>
                    @if(in_array(Auth::user()->role,[\App\Enums\UserRole::SECURITY_OFFICER,\App\Enums\UserRole::DATA_PROTECTION_OFFICER]) && !empty($asset->linksTo))
                        <div class="mb-6">
                            <label for="links_to"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Links To Asset")}}</label>
                            <a href="{{route("assets.show",$asset->links_to_id)}}" id="links_to"
                               class="no-underline hover:underline"
                               target="_blank">{{$asset->linksTo->name}}</a>
                        </div>
                    @endif
                    @if($asset->children->count()>0 && in_array(Auth::user()->role,[\App\Enums\UserRole::SECURITY_OFFICER,\App\Enums\UserRole::DATA_PROTECTION_OFFICER]))
                        <div class="flex-grow border-t border-gray-400"></div>
                        <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Children")}}</h2>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("ID")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Name")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Type")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("SKU")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("IP")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("MAC")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Manufacturer")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Location")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Action")}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($asset->children as $asset)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">{{$asset->id}}</td>
                                        <td class="px-6 py-4">{{$asset->name}}</td>
                                        <td class="px-6 py-4">{{$asset->type->name}}</td>
                                        <td class="px-6 py-4">{{$asset->sku}}</td>
                                        <td class="px-6 py-4">{{$asset->ip_address}}</td>
                                        <td class="px-6 py-4">{{$asset->mac_address}}</td>
                                        <td class="px-6 py-4">{{$asset->manufacturer}}</td>
                                        <td class="px-6 py-4">{{$asset->location}}</td>
                                        <td class="px-6 py-4">
                                            @can("update",$asset)
                                                <a href="{{route("assets.edit",$asset->id)}}"
                                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    {{__("Manage")}}
                                                </a>
                                            @else
                                                <a href="{{route("assets.show",$asset->id)}}"
                                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                {{__("View")}}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
