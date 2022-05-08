<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("Threats")}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <form method="GET" action="{{route('threats.index')}}">
                            <div class="mb-6">
                                <label for="filter"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name/Description")}}</label>
                                <div class="flex">
                                    <input type="text" id="filter" name="filter"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           value="{{$filter}}">
                                    <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Search")}}</button>
                                </div>
                            </div>
                        </form>
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
                                    {{__("Description")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Controls")}}
                                </th>
                                <!--
                                <th scope="col" class="px-6 py-3">
                                    {{__("Assets")}}
                                </th>
                                -->
                                <th scope="col" class="px-6 py-3">
                                    {{__("Action")}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($threats as $threat)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{$threat->id}}</td>
                                    <td class="px-6 py-4">{{$threat->name}}</td>
                                    <td class="px-6 py-4">{{$threat->description}}</td>
                                    <td class="px-6 py-4">{{$threat->controls->count()}}</td>
                                    <td class="px-6 py-4">
                                        @can("update",$threat)
                                            <a href="{{route("threats.edit",$threat->id)}}"
                                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                {{__("Manage")}}
                                            </a>
                                        @else
                                            <a href="{{route("threats.show",$threat->id)}}"
                                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                {{__("View")}}</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $threats->links() }}
                        @can("create",\App\Models\Threat::class)
                            <div class="flex justify-center">
                                <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800"
                                   href="{{route('threats.create')}}" target="_blank">Create</a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
