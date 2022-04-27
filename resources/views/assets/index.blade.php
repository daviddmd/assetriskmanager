<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("Assets")}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <form method="GET" action="{{route('assets.index')}}">
                            <div class="mb-6">
                                <label for="asset_type"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Asset Type")}}</label>
                                <select name="asset_type" id="asset_type"
                                        class="form-select w-full appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                    <option value="" selected>{{__("Any")}}</option>
                                    @foreach($assetTypes as $assetType)
                                        <option
                                            value="{{ $assetType->id }}" {{$asset_type_id == $assetType->id ? "selected" : ""}}>
                                            {{ $assetType->name  }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="filter"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name/E-Mail")}}</label>
                                <input type="text" id="filter" name="filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$filter}}">
                            </div>
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Search")}}</button>
                        </form>
                        @can("create",\App\Models\Asset::class)
                            <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800"
                               href="{{route('assets.create')}}" target="_blank">Create</a>
                        @endcan
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
                                    {{__("Manager")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Action")}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assets as $asset)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{$asset->id}}</td>
                                    <td class="px-6 py-4">{{$asset->name}}</td>
                                    <td class="px-6 py-4">{{$asset->type->name}}</td>
                                    <td class="px-6 py-4">{{$asset->sku}}</td>
                                    <td class="px-6 py-4">{{$asset->ip_address}}</td>
                                    <td class="px-6 py-4">{{$asset->mac_address}}</td>
                                    <td class="px-6 py-4">{{$asset->manufacturer}}</td>
                                    <td class="px-6 py-4">{{$asset->location}}</td>
                                    <td class="px-6 py-4">{{$asset->manager->name}}</td>
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
                        {{ $assets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
