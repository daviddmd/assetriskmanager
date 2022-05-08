<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Reports")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                            data-tabs-toggle="#tabs" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="dashboard-tab" data-tabs-target="#asset_list" type="button" role="tab"
                                    aria-controls="asset_list" aria-selected="false">{{__("Asset List")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="settings-tab" data-tabs-target="#risk_records" type="button" role="tab"
                                    aria-controls="risk_records" aria-selected="false">{{__("Risk Records")}}
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="contacts-tab" data-tabs-target="#dependency_graph" type="button" role="tab"
                                    aria-controls="dependency_graph" aria-selected="false">{{__("Dependency Graph")}}
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div id="tabs">
                        <div class="hidden p-4" id="asset_list" role="tabpanel"
                             aria-labelledby="asset_list-tab">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
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
                                        {{__("Type")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("IP")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("FQDN")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Integrity Appreciation")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Availability Appreciation")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Confidentiality Appreciation")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Total Appreciation")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Risk After Controls")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Action")}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assets as $asset)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                                        <td class="px-6 py-4">{{$asset->id}}</td>
                                        <td class="px-6 py-4">{{$asset->name}}</td>
                                        <td class="px-6 py-4">{{$asset->description}}</td>
                                        <td class="px-6 py-4">{{$asset->type->name}}</td>
                                        <td class="px-6 py-4">{{$asset->ip_address}}</td>
                                        <td class="px-6 py-4">{{$asset->fqdn}}</td>
                                        <td
                                            style="background-color: {{$asset->color($asset->integrity_appreciation)}}"
                                            class="px-6 py-4">{{$asset->integrity_appreciation}}</td>
                                        <td
                                            style="background-color: {{$asset->color($asset->availability_appreciation)}}"
                                            class="px-6 py-4">{{$asset->availability_appreciation}}</td>
                                        <td
                                            style="background-color: {{$asset->color($asset->confidentiality_appreciation)}}"
                                            class="px-6 py-4">{{$asset->confidentiality_appreciation}}</td>
                                        <td
                                            style="background-color: {{$asset->color($asset->totalAppreciation())}}"
                                            class="px-6 py-4">{{$asset->totalAppreciation()}}</td>
                                        <td
                                            style="background-color: {{$asset->color($asset->highestRemainingRisk())}}"
                                            class="px-6 py-4">{{$asset->highestRemainingRisk()}}</td>
                                        <td class="px-6 py-4">
                                            @can("update",$asset)
                                                <a href="{{route("assets.edit",$asset->id)}}"
                                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    {{__("Manage")}}
                                                </a>
                                            @else
                                                <a href="{{route("assets.show",$asset->id)}}"
                                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    {{__("View")}}
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="hidden p-4" id="risk_records" role="tabpanel"
                             aria-labelledby="risk_records-tab">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Asset ID")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Name")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Threat")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Availability Impact")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Confidentiality Impact")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Integrity Impact")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Absolute Risk")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Controls")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Residual Risk After Controls")}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assets as $asset)
                                    @foreach($asset->threats as $threat)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                                            <td class="px-6 py-4">{{$asset->id}}</td>
                                            <td class="px-6 py-4">{{$asset->name}}</td>
                                            <td class="px-6 py-4">{{$threat->threat->name}}</td>
                                            <td style="background-color: {{$threat->color($threat->availability_impact)}}"
                                                class="px-3 py-4">{{$threat->availability_impact}}</td>
                                            <td style="background-color: {{$threat->color($threat->integrity_impact)}}"
                                                class="px-3 py-4">{{$threat->integrity_impact}}</td>
                                            <td style="background-color: {{$threat->color($threat->confidentiality_impact)}}"
                                                class="px-3 py-4">{{$threat->confidentiality_impact}}</td>
                                            <td style="background-color: {{$threat->absoluteRiskColor($threat->absoluteRisk())}}"
                                                class="px-3 py-4">{{$threat->absoluteRisk()}}</td>
                                            <td class="px-3 py-4">{{$threat->controls()->count()}}</td>
                                            <td style="background-color: {{$threat->color($threat->availability_impact)}}"
                                                class="px-3 py-4">{{$threat->residual_risk}}</td>
                                        </tr>

                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="hidden p-4" id="dependency_graph"
                             role="tabpanel"
                             aria-labelledby="dependency_graph-tab">
                            <b>Dependency Graph</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
