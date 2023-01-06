<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Edit Permanent Contact Point")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST"
                          action="{{route('permanent-contact-point.update',$permanent_contact_point->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="mb-6">
                            <label for="entity_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Entity Name")}}</label>
                            <input type="text" id="entity_name" name="entity_name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->entity_name}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="permanent_contact_point_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Permanent Contact Point Name")}}</label>
                            <input type="text" id="permanent_contact_point_name" name="permanent_contact_point_name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->permanent_contact_point_name}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="main_email_address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Main Email Address")}}</label>
                            <input type="email" id="main_email_address" name="main_email_address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->main_email_address}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="secondary_email_address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Secondary Email Address")}}</label>
                            <input type="email" id="secondary_email_address" name="secondary_email_address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->secondary_email_address}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="main_landline_phone_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Main Landline Phone Number")}}</label>
                            <input type="text" id="main_landline_phone_number" name="main_landline_phone_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->main_landline_phone_number}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="secondary_landline_phone_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Secondary Landline Phone Number")}}</label>
                            <input type="text" id="secondary_landline_phone_number"
                                   name="secondary_landline_phone_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->secondary_landline_phone_number}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="main_mobile_phone_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Main Mobile Phone Number")}}</label>
                            <input type="text" id="main_mobile_phone_number" name="main_mobile_phone_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->main_mobile_phone_number}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="secondary_mobile_phone_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Secondary Mobile Phone Number")}}</label>
                            <input type="text" id="secondary_mobile_phone_number" name="secondary_mobile_phone_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   value="{{$permanent_contact_point->secondary_mobile_phone_number}}"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="other_alternative_contacts"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Other/Alternative Contacts")}}</label>
                            <textarea name="other_alternative_contacts" id="other_alternative_contacts"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{$permanent_contact_point->other_alternative_contacts}}</textarea>
                        </div>
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Create")}}</button>
                    </form>
                    <div class="py-2">
                        <form method="POST"
                              action="{{route('permanent-contact-point.destroy',$permanent_contact_point->id)}}">
                            @csrf
                            @method("DELETE")
                            @include("common.delete_button",["message"=>__("Are you sure you want to delete this Permanent Contact Point?")])
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
