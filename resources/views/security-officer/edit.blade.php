<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Manage Security Officer")}}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('security-officer.update',$security_officer->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="mb-6">
                            <label for="entity_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Entity Name")}}</label>
                            <input type="text" id="entity_name" name="entity_name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$security_officer->entity_name}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                            <input type="text" id="name" name="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$security_officer->name}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="role"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Role")}}</label>
                            <input type="text" id="role" name="role"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$security_officer->role}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="email_address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Email Address")}}</label>
                            <input type="email" id="email_address" name="email_address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$security_officer->email_address}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="landline_phone_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Landline Phone Number")}}</label>
                            <input type="text" id="landline_phone_number" name="landline_phone_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$security_officer->landline_phone_number}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="mobile_phone_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Mobile Phone Number")}}</label>
                            <input type="text" id="mobile_phone_number" name="mobile_phone_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$security_officer->mobile_phone_number}}"
                                   required>
                        </div>
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Update")}}</button>
                        @include("common.delete_button")
                    </form>
                    @include("common.delete_prompt",["route" => route('security-officer.destroy',$security_officer->id),"message" => __("Are you sure you want to delete the security officer?")])
                    <div class="flex justify-center">
                        <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800"
                           href="{{route('security-officer.index',"export")}}"
                           target="_blank">{{__("Export")}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
