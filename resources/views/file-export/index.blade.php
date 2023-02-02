<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("File Exports")}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-center">
                        <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-blue-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800"
                           href="{{route('permanent-contact-points.index',"export")}}"
                           target="_blank">{{__("Export Permanent Contact Points")}}</a>
                        <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-blue-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800"
                           href="{{route('security-officer.index',"export")}}"
                           target="_blank">{{__("Export Security Officer")}}</a>
                        <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-blue-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800"
                           href="{{route("reports","export=cncs")}}" target="_blank">{{__("Export Asset List to CNCS")}}</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
