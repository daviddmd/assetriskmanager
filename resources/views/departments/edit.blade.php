<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Edit Department")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('departments.update',$department->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="mb-6">
                            <label for="id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("ID")}}</label>
                            <input type="text" id="id"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$department->id}}"
                                   disabled>
                        </div>
                        <div class="mb-6">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                            <input type="text" id="name" name="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$department->name}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Description")}}</label>
                            <textarea name="description" id="description"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{$department->description}}</textarea>
                        </div>
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Update")}}</button>
                    </form>
                    <div class="py-2">
                        <form method="POST" action="{{route('departments.destroy',$department->id)}}">
                            @csrf
                            @method("DELETE")
                            @include("common.delete_button",["message"=>__("Are you sure you want to delete this department?")])
                        </form>
                    </div>
                    @if($department->users()->exists())
                        <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Members of Department")}}</h2>
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
                                    {{__("E-Mail")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Department")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Assets")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Action")}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($department->users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{$user->id}}</td>
                                    <td class="px-6 py-4">{{$user->name}}</td>
                                    <td class="px-6 py-4">{{$user->email}}</td>
                                    <td class="px-6 py-4">{{!empty($user->department) ? $user->department->name : __("None")}}</td>
                                    <td class="px-6 py-4">{{$user->assets->count()}}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{route("users.edit",$user->id)}}"
                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            {{__("Manage")}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
