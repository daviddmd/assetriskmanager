<div>
    @if(Auth::user()->id==$this->asset->manager_id)
        @if($this->asset->remainingRiskAccepted)
            <div class="flex justify-center">
                <button type="button"
                        wire:click="toggleRemainingRiskAccepted"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    {{__("Undo Accept Remaining Risk")}}
                </button>
            </div>
        @else
            @if($canAcceptRemainingRisk)
                <div class="flex justify-center">
                    <button type="button"
                            wire:click="toggleRemainingRiskAccepted"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        {{__("Accept Remaining Risk")}}
                    </button>
                </div>

            @else
                <h3 class="text-center text-2xl font-normal leading-normal mt-0 mb-2 text-red-600 font-bold">{{__("Accept the Remaining Risks of All Threats Before Accepting the Remaining Risk of this Asset")}}</h3>
                <div class="flex justify-center">
                    <button type="button"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        {{__("Accept Remaining Risk")}}
                    </button>
                </div>

            @endif

        @endif

    @else
        <div class="flex justify-center">
            @if(!$this->asset->remainingRiskAccepted)
                <button type="button"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    {{__("Remaining Risk Not Accepted")}}
                </button>
            @else
                <button type="button"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    {{__("Remaining Risk Accepted")}}
                </button>
            @endif

        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
        <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
            <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-3 py-3">
                    {{__("ID")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("Threat Name")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("Threat Description")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("Total Risk")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("Controls Applied")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("Remaining Risk After Controls")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("Action")}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($asset->threats as $threat)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                    <td class="px-3 py-4">{{$threat->threat->id}}</td>
                    <td class="px-3 py-4">{{$threat->threat->name}}</td>
                    <td class="px-3 py-4">{{$threat->threat->description}}</td>
                    <td style="background-color: {{$threat->totalRiskColor($threat->totalRisk($asset->totalAppreciation()))}}"
                        class="px-3 py-4">
                        {{$threat->totalRisk($asset->totalAppreciation())}}</td>
                    <td class="px-3 py-4">{{$threat->controls()->count()}}</td>

                    <td style="background-color: {{$threat->totalRiskColor($threat->residual_risk)}}"
                        class="px-3 py-4">
                        {{$threat->residual_risk == 0 ? "":$threat->residual_risk}}
                    </td>
                    <td class="px-3 py-4">
                        <a href="{{route("threats.show",$threat->threat->id)}}"
                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                           target="_blank">
                            {{__("View")}}
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>
