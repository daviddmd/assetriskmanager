<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Edit User")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('users.update',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="mb-6">
                            <label for="id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("ID")}}</label>
                            <input type="text" id="id"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$user->id}}"
                                   disabled>
                        </div>
                        <div class="mb-6">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                            <input type="text" id="name" name="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$user->name}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="department"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Department")}}</label>
                            <select name="department" id="department"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                @if(!empty($user->department))
                                    <option value="">No Department</option>
                                    @foreach($departments as $department)
                                        <option
                                            value="{{ $department->id }}" {{ $user->department->id == $department->id  ? "selected" : "" }}>
                                            {{ $department->name  }}
                                        </option>
                                    @endforeach
                                @else
                                    <option selected value="">No Department</option>
                                    @foreach($departments as $department)
                                        <option
                                            value="{{ $department->id }}">
                                            {{ $department->name  }}
                                        </option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="role"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Role")}}</label>
                            <select name="role" id="role"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            {{Auth::user()->role != \App\Enums\UserRole::ADMINISTRATOR ? "disabled" : ""}}>
                                @foreach(\App\Enums\UserRole::cases() as $role)
                                    <option
                                        value="{{ $role->value }}" {{ $user->role->value == $role->value  ? "selected" : "" }}>
                                        {{ __("enums.".$role->name)  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if(Auth::user()->role != \App\Enums\UserRole::ADMINISTRATOR)
                            <input type="hidden" name="role" value="{{$user->role->value}}">
                        @endif
                        <div class="mb-6">
                            <label for="active"
                                   class="form-check-label inline-block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Active")}}</label>
                            <input
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="checkbox" value="" name="active" id="active" {{$user->active ? "checked" : ""}}>

                        </div>
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Update")}}</button>
                    </form>
                    <div class="flex-grow border-t border-gray-400"></div>
                    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">Assets</h2>
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
                            @foreach($user->assets as $asset)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{$asset->id}}</td>
                                    <td class="px-6 py-4">{{$asset->name}}</td>
                                    <td class="px-6 py-4">{{$asset->type->name}}</td>
                                    <td class="px-6 py-4">{{$asset->sku}}</td>
                                    <td class="px-6 py-4">{{$asset->ip_address}}</td>
                                    <td class="px-6 py-4">{{$asset->mac_address}}</td>
                                    <td class="px-6 py-4">{{$asset->manufacturer}}</td>
                                    <td class="px-6 py-4">{{$asset->location}}</td>
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
                                            </a>
                                        @endcan
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
