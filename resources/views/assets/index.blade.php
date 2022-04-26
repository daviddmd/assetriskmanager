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
