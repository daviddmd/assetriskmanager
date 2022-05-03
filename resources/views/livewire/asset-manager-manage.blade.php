@if(in_array(Auth::user()->role,[\App\Enums\UserRole::SECURITY_OFFICER,\App\Enums\UserRole::DATA_PROTECTION_OFFICER]))
    @if($showSearch)
        <div>
            @livewire("user-search")
        </div>
    @else
        <div class="mb-6">
            <label for="manager"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manager")}}</label>
            <div class="flex">
                <input type="hidden" name="manager" value="{{$asset->manager_id}}">
                <div class="border-double border-4 border-black">
                    <a href="{{route("users.show",$asset->manager->id)}}" id="manager" target="_blank"
                       class="no-underline hover:underline">{{$asset->manager->name . ":" . $asset->manager->email}}</a>
                </div>
                <button wire:click="toggleSearch" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{__("Edit")}}</button>
            </div>
            @endif
        </div>
        @else
            <input type="hidden" name="manager" value="{{$asset->manager_id}}">
        @endif
