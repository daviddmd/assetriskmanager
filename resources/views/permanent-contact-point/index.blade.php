<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("Permanent Contact Points")}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex justify-center">
                            <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800" href="{{route('permanent-contact-point.create')}}" target="_blank">{{__("Create")}}</a>
                            <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-blue-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800" href="{{route('permanent-contact-point.index',"export")}}" target="_blank">{{__("Export")}}</a>
                        </div>
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
                                    {{__("Main E-Mail")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Main Landline Phone")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Main Mobile Phone")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Action")}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permanentContactPoints as $permanentContactPoint)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{$permanentContactPoint->id}}</td>
                                    <td class="px-6 py-4">{{$permanentContactPoint->permanent_contact_point_name}}</td>
                                    <td class="px-6 py-4">{{$permanentContactPoint->main_email_address}}</td>
                                    <td class="px-6 py-4">{{$permanentContactPoint->main_landline_phone_number}}</td>
                                    <td class="px-6 py-4">{{$permanentContactPoint->main_mobile_phone_number}}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{route("permanent-contact-point.edit",$permanentContactPoint->id)}}"
                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            {{__("Manage")}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
