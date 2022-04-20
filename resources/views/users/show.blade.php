<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("View User")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="department"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Department")}}</label>
                        <select name="department" id="department"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                disabled>
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
                                disabled>
                            @foreach(\App\Enums\UserRole::cases() as $role)
                                <option
                                    value="{{ $role->value }}" {{ $user->role->value == $role->value  ? "selected" : "" }}>
                                    {{ __("enums.".$role->name)  }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="active"
                               class="form-check-label inline-block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Active")}}</label>
                        <input
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="checkbox" value="" name="active" id="active" {{$user->active ? "checked" : ""}} disabled>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
