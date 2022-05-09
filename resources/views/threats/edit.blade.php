<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Edit Threat")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('threats.update',$threat->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="mb-6">
                            <label for="id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("ID")}}</label>
                            <input type="text" id="id"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$threat->id}}"
                                   disabled>
                        </div>
                        <div class="mb-6">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                            <input type="text" id="name" name="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$threat->name}}" required>
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Description")}}</label>
                            <textarea name="description" id="description"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{$threat->description}}</textarea>
                        </div>
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Update")}}</button>
                    </form>
                    <form method="POST" action="{{route('threats.destroy',$threat->id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" onclick="return confirm('{{__("Are you sure you want to delete?")}}')"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{{__("Delete")}}</button>
                    </form>
                    <div class="flex-grow border-t border-gray-400"></div>
                    @livewire("threat-controls-manage",["threat"=>$threat])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
