<div>
    @if(in_array(Auth::user()->role,[\App\Enums\UserRole::SECURITY_OFFICER,\App\Enums\UserRole::DATA_PROTECTION_OFFICER]))
        <div class="mb-6">
            <label for="manager"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manager")}}</label>
            @if($showSearch)
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" wire:model.lazy="searchTerm" placeholder="{{__("User Name or Email")}}">
                <select name="manager" id="manager"
                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        required>
                    <option value="" selected disabled>{{__("Select an User")}}</option>
                    @foreach($users as $user)
                        <option
                            value="{{ $user->id }}">
                            {{ "$user->name:$user->email" }}
                        </option>
                    @endforeach
                </select>
            @else
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
</div>
