<div>
    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">Controls</h2>
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
                    {{__("Description")}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__("Action")}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($controls as $control)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{$control->id}}</td>
                    <td class="px-6 py-4">{{$control->name}}</td>
                    <td class="px-6 py-4">{{$control->description}}</td>
                    <td class="px-6 py-4">
                        @can("update",$control)
                            <a href="{{route("controls.edit",$control->id)}}"
                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                {{__("Manage")}}
                            </a>
                            <button wire:click="removeControl({{$control->id}})" type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Remove
                            </button>
                        @else
                            <a href="{{route("controls.show",$control->id)}}"
                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                {{__("View")}}</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mb-3 xl:w-96">
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" wire:model.lazy="searchTerm"
                placeholder="{{__("Control Name/Description")}}">
            <select
                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                aria-label="Select Control to Add"
                wire:model.defer="control">
                <option value="" disabled selected>{{__("Select Control to Add")}}</option>
                @foreach($controls_search as $control)
                    <option
                        value="{{$control->id}}">{{$control->id.":".$control->name.":".$control->description}}</option>
                @endforeach
            </select>
            <button wire:click="addControl" type="button"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{__("Add")}}</button>
        </div>

    </div>
</div>
