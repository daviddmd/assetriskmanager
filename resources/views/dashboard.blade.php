<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                @if(count($assetsWithControlsToValidate)>0)
                    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Assets with Controls to Be Validated")}}</h2>
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
                                {{__("Threats")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Action")}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($assetsWithControlsToValidate as $asset)
                            <tr class="{{$asset->remainingRiskAccepted ? "bg-green-300" : "bg-white"}} border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{$asset->id}}</td>
                                <td class="px-6 py-4">{{$asset->name}}</td>
                                <td class="px-6 py-4">{{$asset->type->name}}</td>
                                <td class="px-6 py-4">{{$asset->threats()->count()}}</td>
                                <td class="px-6 py-4">
                                    <a href="{{route("assets.edit",$asset->id)}}"
                                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        {{__("Manage")}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if(count($tasks)>0)
                    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Pending Tasks")}}</h2>
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
                                {{__("Task Description")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Action")}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{$task["asset"]->id}}</td>
                                <td class="px-6 py-4">{{$task["asset"]->name}}</td>
                                <td class="px-6 py-4">{{$task["asset"]->type->name}}</td>
                                <td class="px-6 py-4">{{$task["message"]}}</td>
                                <td class="px-6 py-4">
                                    <a href="{{route("assets.edit",$task["asset"]->id)}}"
                                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        {{__("Manage")}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
