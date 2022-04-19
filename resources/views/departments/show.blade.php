<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("View Department")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                        <input type="text" id="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$department->name}}" disabled
                        >
                    </div>
                    <div class="mb-6">
                        <label for="description"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Description")}}</label>
                        <textarea id="description"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  disabled>{{$department->description}}</textarea>
                    </div>
                    <div class="mb-6">
                        <label for="users"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Users")}}</label>
                    @foreach($department->users as $user)
                        <a>{{$user->name}}</a>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
