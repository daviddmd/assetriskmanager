<div>
    @if($asset->totalAppreciation()==0)
        <h3 class="text-center text-2xl font-normal leading-normal mt-0 mb-2 text-red-600 font-bold">{{__("Define the Asset Appreciation Before Adding Threats")}}</h3>
        <div class="flex justify-center">
            <button type="button"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{__("Add Threat")}}
            </button>
        </div>
    @else
        <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Threats")}}</h2>
        <div class="flex justify-center">
            <button type="button"
                    wire:click="openCreateThreatDialog"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{__("Add Threat")}}
            </button>
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
        @foreach($threats as $threat)
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-3">
                        {{__("ID")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Name")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Description")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Probability")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Availability Impact")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Integrity Impact")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Confidentiality Impact")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Absolute Risk")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Total Risk")}}
                    </th>
                    <th scope="col" class="px-3 py-3">
                        {{__("Action")}}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                    <td class="px-3 py-4">{{$threat->threat->id}}</td>
                    <td class="px-3 py-4">{{$threat->threat->name}}</td>
                    <td class="px-3 py-4">{{$threat->threat->description}}</td>
                    <td style="background-color: {{$threat->color($threat->probability)}}"
                        class="px-3 py-4">{{$threat->probability}}</td>
                    <td style="background-color: {{$threat->color($threat->availability_impact)}}"
                        class="px-3 py-4">{{$threat->availability_impact}}</td>
                    <td style="background-color: {{$threat->color($threat->integrity_impact)}}"
                        class="px-3 py-4">{{$threat->integrity_impact}}</td>
                    <td style="background-color: {{$threat->color($threat->confidentiality_impact)}}"
                        class="px-3 py-4">{{$threat->confidentiality_impact}}</td>
                    <td style="background-color: {{$threat->absoluteRiskColor($threat->absoluteRisk())}}"
                        class="px-3 py-4">{{$threat->absoluteRisk()}}</td>
                    <td style="background-color: {{$threat->totalRiskColor($threat->totalRisk($asset->totalAppreciation()))}}"
                        class="px-3 py-4">
                        {{$threat->totalRisk($asset->totalAppreciation())}}</td>
                    <td class="px-3 py-4">
                        @can("update",$asset)
                            <button wire:click="editThreat({{$threat->id}})" type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                {{__("Edit")}}
                            </button>
                            <button wire:click="removeThreat({{$threat->id}})" type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                {{__("Remove")}}
                            </button>
                        @else
                            <a href="{{route("threats.show",$threat->threat->id)}}"
                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                {{__("View")}}</a>
                        @endcan
                    </td>
                </tr>
                </tbody>
            </table>
            <h2 class="text-center text-xl font-normal leading-normal mt-0 mb-2">{{__("Controls")}}</h2>
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
                        {{__("Control Type")}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{__("Validated?")}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{__("Action")}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($threat->controls as $control)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                        <td class="px-6 py-4">{{$control->control->id}}</td>
                        <td class="px-6 py-4">{{$control->control->name}}</td>
                        <td class="px-6 py-4">{{$control->control->description}}</td>
                        <td class="px-6 py-4">{{  __("enums.".$control->control_type->name) }}</td>

                        <td class="px-6 py-4">
                            <input
                                wire:click="toggleValidationControl({{$control->id}})"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="checkbox" {{Auth::user()->role!=\App\Enums\UserRole::SECURITY_OFFICER ? "disabled" : ""}}
                                {{$control->validated ? "checked" : ""}}>
                        </td>
                        <td class="px-6 py-4">
                            @can("update",$asset)
                                <button wire:click="removeControl({{$control->id}})"
                                        type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    {{__("Remove")}}
                                </button>
                            @else
                                <a href="{{route("controls.show",$control->control->id)}}"
                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                   target="_blank">
                                    {{__("View")}}</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="flex justify-center">
                <button type="button"
                        wire:click="openCreateThreatControlDialog({{$threat->id}})"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    {{__("Add Control")}}
                </button>
            </div>
            @if(!$loop->last)
                <div class="py-8">
                    <div class="flex-grow border-t border-dashed border-gray-400"></div>
                </div>
            @endif
        @endforeach

        <x-dialog-modal wire:model.live="assetThreatAddDialogOpen">
            <x-slot name="title">
                {{__("Add Threat")}}
            </x-slot>
            <x-slot name="content">
                <form wire:submit="addThreat">
                    <div class="mb-6">
                        <label for="threat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Threat")}}
                        </label>
                        <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="text" wire:model.live="threatSearchTerm"
                            placeholder="{{__("Search for Threat (Name/Description)")}}">
                        <select
                            id="threat"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Select Threat to Add"
                            wire:model="selectedThreat">
                            <option value="" disabled selected>{{__("Select Threat to Add")}}</option>
                            @foreach($threatsSearch as $threat)
                                <option
                                    value="{{$threat->id}}">{{$threat->id.":".$threat->name.":".$threat->description}}</option>
                            @endforeach
                        </select>
                        @error('selectedThreat') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="probability"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Probability")}}
                        </label>
                        <input type="number" id="probability" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="probability">
                        @error('probability') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="availability_impact"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Availability Impact")}}
                        </label>
                        <input type="number" id="availability_impact" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="availability_impact">
                        @error('availability_impact') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="confidentiality_impact"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Confidentiality Impact")}}
                        </label>
                        <input type="number" id="confidentiality_impact" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="confidentiality_impact">
                        @error('confidentiality_impact') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="integrity_impact"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Integrity Impact")}}
                        </label>
                        <input type="number" id="integrity_impact" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="integrity_impact">
                        @error('integrity_impact') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-center">
                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            {{__("Add")}}
                        </x-button>
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('assetThreatAddDialogOpen')"
                                        wire:loading.attr="disabled">
                    {{__("Cancel")}}
                </x-secondary-button>


            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model.live="assetThreatEditDialogOpen">
            <x-slot name="title">
                {{__("Edit Threat")}}
            </x-slot>
            <x-slot name="content">
                <form wire:submit="updateThreat">
                    <div class="mb-6">
                        <label for="probability"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Probability")}}
                        </label>
                        <label for="probability"
                               class="block mb-2 text-xs font-light text-gray-900 dark:text-gray-300">
                            {{__("1-Nonexistent, 2-Low, 3-Medium, 4-High, 5-Very High")}}
                        </label>
                        <input type="number" id="probability" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="probability">
                        @error('probability') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="availability_impact"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Availability Impact")}}
                        </label>
                        <label for="availability_impact"
                               class="block mb-2 text-xs font-light text-gray-900 dark:text-gray-300">
                            {{__("1-Nonexistent, 2-Low, 3-Medium, 4-High, 5-Very High")}}
                        </label>
                        <input type="number" id="availability_impact" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="availability_impact">
                        @error('availability_impact') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="confidentiality_impact"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Confidentiality Impact")}}
                        </label>
                        <label for="confidentiality_impact"
                               class="block mb-2 text-xs font-light text-gray-900 dark:text-gray-300">
                            {{__("1-Nonexistent, 2-Low, 3-Medium, 4-High, 5-Very High")}}
                        </label>
                        <input type="number" id="confidentiality_impact" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="confidentiality_impact">
                        @error('confidentiality_impact') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="integrity_impact"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Integrity Impact")}}
                        </label>
                        <label for="integrity_impact"
                               class="block mb-2 text-xs font-light text-gray-900 dark:text-gray-300">
                            {{__("1-Nonexistent, 2-Low, 3-Medium, 4-High, 5-Very High")}}
                        </label>
                        <input type="number" id="integrity_impact" min="1" max="5"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="integrity_impact">
                        @error('integrity_impact') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="total_risk"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Total Risk")}}
                        </label>
                        <label for="total_risk"
                               class="block mb-2 text-xs font-light text-gray-900 dark:text-gray-300">
                            {{__("Highest Impact*Probability*Total Asset Valuation")}}
                        </label>
                        <input type="number" id="total_risk"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="total_risk" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="residual_risk_accepted"
                               class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Remaining Risk Accepted?")}}
                        </label>
                        <input type="checkbox" id="residual_risk_accepted"
                               {{$this->residual_risk_accepted ? "checked" : ""}}
                               class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                               wire:model="residual_risk_accepted">
                    </div>
                    <div class="mb-6">
                        <label for="residual_risk"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Remaining Risk After Controls")}}
                        </label>
                        <label for="residual_risk"
                               class="block mb-2 text-xs font-light text-gray-900 dark:text-gray-300">
                            {{__("1-25 Nonexistent, 25-50 Low, 50-75 Average, 75-100 High, 100-125 Very High")}}
                        </label>
                        <input type="number" id="residual_risk" min="0" max="125"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               wire:model="residual_risk">
                        @error('residual_risk') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-center">
                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            {{__("Update")}}
                        </x-button>
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('assetThreatEditDialogOpen')"
                                        wire:loading.attr="disabled">
                    {{__("Cancel")}}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model.live="assetThreatControlAddDialogOpen">
            <x-slot name="title">
                {{__("Add Control")}}
            </x-slot>
            <x-slot name="content">
                <form wire:submit="addControl">
                    <div class="mb-6">
                        <label for="control" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Control")}}
                        </label>
                        <select
                            id="control"
                            wire:model="selectedControl"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            required>
                            <option selected disabled value="">{{__("Select a Control to Add")}}</option>
                            @foreach($availableControls as $control)
                                <option
                                    value="{{ $control->id }}">
                                    {{ $control->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('selectedControl') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="control_type"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{__("Control Type")}}
                        </label>
                        <select id="control_type"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                wire:model="selectedControlType"
                                required>
                            <option selected disabled value="">{{__("Select a Control Type")}}</option>
                            @foreach(\App\Enums\ControlType::cases() as $controlType)
                                <option
                                    value="{{ $controlType->value }}">
                                    {{ __("enums.".$controlType->name)  }}
                                </option>
                            @endforeach
                        </select>
                        @error('selectedControlType') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-center">
                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            {{__("Add")}}
                        </x-button>
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('assetThreatControlAddDialogOpen')"
                                        wire:loading.attr="disabled">
                    {{__("Cancel")}}
                </x-secondary-button>


            </x-slot>
        </x-dialog-modal>


    </div>
</div>
