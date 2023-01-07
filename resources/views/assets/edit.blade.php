<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Edit Asset")}}</h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tabs"
                            data-tabs-toggle="#tabsContent" role="tabList">
                            <li class="mr-2" role="presentation">
                                <button
                                        class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                        id="details-tab" data-tabs-target="#details" type="button" role="tab"
                                        aria-controls="details" aria-selected="true">{{__("Details")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                        class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                        id="threats-controls-tab" data-tabs-target="#threats_controls" type="button"
                                        role="tab"
                                        aria-controls="threats_controls"
                                        aria-selected="false">{{__("Threats/Controls")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                        class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                        id="risk-summary-tab" data-tabs-target="#risk_summary" type="button" role="tab"
                                        aria-controls="risk_summary" aria-selected="false">{{__("Risk Summary")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                        class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                        id="logs-tab" data-tabs-target="#logs" type="button" role="tab"
                                        aria-controls="logs" aria-selected="false">{{__("Logs")}}
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div id="tabsContent">
                        <div class="hidden p-4" id="threats_controls" role="tabpanel"
                             aria-labelledby="threats-controls-tab">
                            @livewire("asset-threats-controls-manage",["asset"=>$asset])
                        </div>
                        <div class="hidden p-4" id="risk_summary" role="tabpanel"
                             aria-labelledby="risk-summary-tab">
                            @livewire("asset-risk-summary",["asset"=>$asset])

                        </div>
                        <div class="hidden p-4" id="logs" role="tabpanel"
                             aria-labelledby="logs-tab">
                            @livewire("asset-logs",["asset"=>$asset])

                        </div>
                        <div class="hidden p-4" id="details" role="tabpanel"
                             aria-labelledby="details-tab">
                            <form method="POST" action="{{route('assets.update',$asset->id)}}">
                                @csrf
                                @method("PUT")
                                <div class="mb-6">
                                    <label for="name"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                                    <input type="text" id="name" name="name"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{$asset->name}}"
                                           required>
                                </div>
                                <div class="mb-6">
                                    <label for="description"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Description")}}</label>
                                    <textarea name="description" id="description"
                                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{$asset->description}}</textarea>
                                </div>
                                <div class="mb-6">
                                    <label for="type"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Asset Type")}}</label>
                                    <select name="type" id="type"
                                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            required>
                                        @foreach($assetTypes as $assetType)
                                            <option
                                                    {{$asset->type->id == $assetType->id ? "selected" : ""}}
                                                    value="{{ $assetType->id }}">
                                                {{ $assetType->name  }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @livewire("asset-manager-manage",["asset"=>$asset])
                                <div class="mb-6">
                                    <label for="sku"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("SKU/Inventory ID")}}</label>
                                    <input type="text" id="sku" name="sku"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{$asset->sku}}"
                                           required>
                                </div>
                                <div class="mb-6">
                                    <label for="manufacturer"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer")}}</label>
                                    <input type="text" id="manufacturer" name="manufacturer"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{$asset->manufacturer}}"
                                           required>
                                </div>
                                <div class="mb-6">
                                    <label for="location"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Location")}}</label>
                                    <input type="text" id="location" name="location"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{$asset->location}}"
                                           required>
                                </div>
                                <div class="mb-6"
                                     x-data="{ visible: {{$asset->manufacturer_contract_type != \App\Enums\ManufacturerContractType::NONE ? "true" : "false"}} }">
                                    <label for="manufacturer_contract_type"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Type")}}</label>
                                    <select name="manufacturer_contract_type" id="manufacturer_contract_type"
                                            x-on:change="visible = $event.target.value != '{{\App\Enums\ManufacturerContractType::NONE->value}}'"
                                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            required>
                                        @foreach(\App\Enums\ManufacturerContractType::cases() as $role)
                                            <option
                                                    {{$asset->manufacturer_contract_type == $role ? "selected" : ""}}
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
                                                   value="{{$asset->manufacturer_contract_provider}}"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="mb-6">
                                            <label for="contract_date_range_picker"
                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manufacturer Contract Date")}}</label>
                                            <div date-rangepicker datepicker-format="yyyy-mm-dd"
                                                 class="flex items-center"
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
                                                           id="manufacturer_contract_beginning_date" type="text"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                           value="{{$asset->manufacturer_contract_beginning_date}}"
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
                                                           value="{{$asset->manufacturer_contract_ending_date}}"
                                                           placeholder="{{__('Contract Ending Date')}}">
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
                                           value="{{$asset->mac_address}}">
                                </div>
                                <div class="mb-6">
                                    <label for="fqdn"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("FQDN")}}</label>
                                    <input type="text" id="fqdn" name="fqdn"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{$asset->fqdn}}">
                                </div>
                                <div class="mb-6">
                                    <label for="ip_address"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("IP Address")}}</label>
                                    <input type="text" id="ip_address" name="ip_address"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{$asset->ip_address}}">
                                </div>
                                <div class="mb-6">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                {{__("Availability Appreciation")}}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{__("Integrity Appreciation")}}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{__("Confidentiality Appreciation")}}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{__("Total Appreciation")}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                <input type="number" id="availability_appreciation"
                                                       name="availability_appreciation"
                                                       min="1" max="5"
                                                       value="{{ $asset->availability_appreciation }}"
                                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       style="background-color: {{$asset->color($asset->availability_appreciation)}}"
                                                       required>
                                            </td>
                                            <td class="px-6 py-4">
                                                <input type="number" id="integrity_appreciation"
                                                       name="integrity_appreciation"
                                                       min="1" max="5"
                                                       value="{{$asset->integrity_appreciation }}"
                                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       style="background-color: {{$asset->color($asset->integrity_appreciation)}}"
                                                       required>
                                            </td>
                                            <td class="px-6 py-4">
                                                <input type="number" id="confidentiality_appreciation"
                                                       name="confidentiality_appreciation"
                                                       min="1" max="5"
                                                       value="{{$asset->confidentiality_appreciation }}"
                                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       style="background-color: {{$asset->color($asset->confidentiality_appreciation)}}"
                                                       required>
                                            </td>
                                            <td class="px-6 py-4">
                                                <input type="number" id="total_appreciation"
                                                       value="{{$asset->totalAppreciation() }}"
                                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       style="background-color: {{$asset->color($asset->totalAppreciation())}}"
                                                       disabled>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-6">
                                    <label for="export"
                                           class="form-check-label inline-block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Export to CNCS?")}}</label>
                                    <input
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            type="checkbox" name="export"
                                            id="export" {{$asset->export ? "checked" : ""}}>
                                </div>
                                <div class="mb-6">
                                    <label for="active"
                                           class="form-check-label inline-block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Active?")}}</label>
                                    <input
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            type="checkbox" name="active"
                                            id="active" {{$asset->active ? "checked" : ""}}>
                                </div>
                                @livewire("asset-links-to-manage",["asset"=>$asset])
                                <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Update")}}</button>
                            </form>
                            @can("delete",$asset)
                                <div class="py-2">
                                    <form method="POST" action="{{route("assets.destroy",$asset->id)}}">
                                        @csrf
                                        @method("DELETE")
                                        @include("common.delete_button",["message"=>__("Are you sure you want to delete this asset? This will delete all associated information with it.")])
                                    </form>
                                </div>
                            @endcan
                            @if(!empty($asset->availableChildren()))
                                <div class="py-2">
                                    <div class="flex-grow border-t border-gray-400"></div>
                                </div>
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
                                        @foreach($asset->availableChildren() as $child)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td class="px-6 py-4">{{$child->id}}</td>
                                                <td class="px-6 py-4">{{$child->name}}</td>
                                                <td class="px-6 py-4">{{$child->type->name}}</td>
                                                <td class="px-6 py-4">{{$child->sku}}</td>
                                                <td class="px-6 py-4">{{$child->ip_address}}</td>
                                                <td class="px-6 py-4">{{$child->mac_address}}</td>
                                                <td class="px-6 py-4">{{$child->manufacturer}}</td>
                                                <td class="px-6 py-4">{{$child->location}}</td>
                                                <td class="px-6 py-4">
                                                    @can("update",$child)
                                                        <a href="{{route("assets.edit",$child->id)}}"
                                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                            {{__("Manage")}}
                                                        </a>
                                                    @else
                                                        <a href="{{route("assets.show",$child->id)}}"
                                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                            {{__("View")}}
                                                        </a>
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
        </div>
    </div>
    @push("js")
        <script>
            window.addEventListener('load', async function () {
                /*
                This script opens the tab according to the URI fragment, that may come from the dashboard.
                If no fragment is present, the normal behaviour will ensue, meaning the default tab to be opened will
                be the asset details tab.
                 */
                let current_hash = window.location.hash.substring(1);
                const tabElements = [
                    {
                        id: 'details-tab',
                        triggerEl: document.querySelector('#details-tab'),
                        targetEl: document.querySelector('#details')
                    },
                    {
                        id: 'threats-controls-tab',
                        triggerEl: document.querySelector('#threats-controls-tab'),
                        targetEl: document.querySelector('#threats_controls')
                    },
                    {
                        id: 'risk-summary-tab',
                        triggerEl: document.querySelector('#risk-summary-tab'),
                        targetEl: document.querySelector('#risk_summary')
                    },
                    {
                        id: 'logs-tab',
                        triggerEl: document.querySelector('#logs-tab'),
                        targetEl: document.querySelector('#logs')
                    }
                ];
                let elements = tabElements.map(element => (element.id));
                current_hash = elements.includes(current_hash) ? current_hash : elements[0];
                const options = {
                    activeClasses: 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
                    inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300'
                };
                const tabs = new Tabs(tabElements, options);
                if (current_hash) {
                    history.pushState("", document.title, window.location.pathname + window.location.search);
                    tabs.show(current_hash);
                }
            });


        </script>
    @endpush
</x-app-layout>
