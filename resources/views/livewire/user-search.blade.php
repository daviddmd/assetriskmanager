<div class="mb-6">
    <label for="manager"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Manager")}}</label>
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
</div>
