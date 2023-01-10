<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__("Imports")}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include("common.model_import_form",["model"=>"assets","message" => __("Import Assets")])
                    @include("common.model_import_form",["model"=>"asset-types","message" => __("Import Asset Types")])
                    @include("common.model_import_form",["model"=>"controls","message" => __("Import Controls")])
                    @include("common.model_import_form",["model"=>"departments","message" => __("Import Departments")])
                    @include("common.model_import_form",["model"=>"permanent-contact-points","message" => __("Import Permanent Contact Points")])
                    @include("common.model_import_form",["model"=>"security-officer","message" => __("Import Security Officer")])
                    @include("common.model_import_form",["model"=>"threats","message" => __("Import Threats")])
                    @if(!config("ldap.enabled") && Auth::user()->role == \App\Enums\UserRole::ADMINISTRATOR)
                        @include("common.model_import_form",["model"=>"users","message" => __("Import Users")])
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
