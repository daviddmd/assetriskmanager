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
                                    id="settings-tab" data-tabs-target="#risk_map" type="button" role="tab"
                                    aria-controls="risk_map" aria-selected="false">{{__("Risk Map")}}
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
                                            style="background-color: {{App\Models\AssetThreat::totalRiskColor($asset->highestRemainingRisk())}}"
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

                            <div class="flex justify-center">
                                <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-blue-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800"
                                   href="{{route("reports","export=asset_list")}}" target="_blank">{{__("Export")}}</a>
                            </div>
                        </div>
                        <div class="hidden p-4" id="risk_map" role="tabpanel"
                             aria-labelledby="risk_map-tab">

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Asset ID")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Asset Name")}}
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
                                        {{__("Probability")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Asset Appreciation")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Total Risk")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Controls")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{__("Remaining Risk After Controls")}}
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
                                            <td style="background-color: {{$threat->color($threat->confidentiality_impact)}}"
                                                class="px-3 py-4">{{$threat->confidentiality_impact}}</td>
                                            <td style="background-color: {{$threat->color($threat->integrity_impact)}}"
                                                class="px-3 py-4">{{$threat->integrity_impact}}</td>
                                            <td style="background-color: {{$threat->color($threat->probability)}}"
                                                class="px-3 py-4">{{$threat->probability}}</td>
                                            <td style="background-color: {{$asset->color($asset->totalAppreciation())}}"
                                                class="px-3 py-4">{{$asset->totalAppreciation()}}</td>
                                            <td style="background-color: {{$threat->totalRiskColor($threat->totalRisk($asset->totalAppreciation()))}}"
                                                class="px-3 py-4">{{$threat->totalRisk($asset->totalAppreciation())}}</td>
                                            <td class="px-3 py-4">{{$threat->controls()->count()}}</td>
                                            <td style="background-color: {{$threat->totalRiskColor($threat->residual_risk)}}"
                                                class="px-3 py-4">{{$threat->residual_risk}}</td>
                                        </tr>

                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                            <div class="flex justify-center">
                                <a class="inline-flex items-center h-10 px-5 m-2 text-sm text-blue-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800"
                                   href="{{route("reports","export=risk_map")}}" target="_blank">{{__("Export")}}</a>
                            </div>
                        </div>
                        <div class="hidden p-4" id="dependency_graph"
                             role="tabpanel"
                             aria-labelledby="dependency_graph-tab">
                            <div id="cy" class="h-screen w-screen text-base">

                            </div>
                            <div class="flex justify-center">
                                <button onclick="saveImage()" type="button"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push("js")
        <script>
            var imageBlob = null;

            function saveImage() {
                if (imageBlob != null) {
                    saveAs(imageBlob, "graph.png");
                }
            }

            window.addEventListener('load', async function () {
                cytoscape.use(dagre);
                var cy = (window.cy = cytoscape({
                    container: document.getElementById("cy"),

                    boxSelectionEnabled: false,
                    autounselectify: true,

                    layout: {
                        name: "dagre"
                    },

                    style: [
                        {
                            selector: "node",
                            style: {
                                "label": "data(data)",
                                "text-valign": "center",
                                "text-halign": "center",
                                "shape": "rectangle",
                                "border-width": 2,
                                "border-color": "black",
                                "border-style": "dotted",
                                "color": "black",
                                "text-background-padding": "data(width)",
                                "background-color": "skyblue",
                                "text-wrap": "wrap",
                                'width': "data(width)",
                                'height': "data(height)",

                            }
                        },

                        {
                            selector: "edge",
                            style: {
                                "curve-style": "bezier",
                                width: 4,
                                "target-arrow-shape": "triangle",
                                "line-color": "#9dbaea",
                                "target-arrow-color": "#9dbaea"
                            }
                        }
                    ],
                    //width: 12*number characters
                    //height: 30*number lines
                    elements: {
                        nodes: [
                            {
                                data: {
                                    id: "n0",
                                    data: "Asset 1\n192.168.1.1\nasset.1.rjsc.local",
                                    link: "https://www.google.com",
                                    width: "216",
                                    height: "90"
                                }
                            },
                            {
                                data: {
                                    id: "n1",
                                    data: "Asset 2\n192.168.1.2\nasset.2.rjsc.local",
                                    link: "https://www.google.com",
                                    width: "216",
                                    height: "90"
                                }
                            },
                            {
                                data: {
                                    id: "n2",
                                    data: "Asset 4\n192.168.1.4\nasset.4.rjsc.local",
                                    link: "https://www.google.com",
                                    width: "216",
                                    height: "90"
                                }
                            },
                            {
                                data: {
                                    id: "n3",
                                    data: "Asset 3 Lorem Ipsum BlaBla\n192.168.1.3\nasset.3.rjsc.local",
                                    link: "https://www.google.com",
                                    width: "312",
                                    height: "90"
                                }
                            },

                        ],
                        edges: [
                            {data: {source: "n1", target: "n0"}},
                            {data: {source: "n3", target: "n0"}},
                            {data: {source: "n2", target: "n1"}},


                        ]
                    }
                }));
                cy.resize();
                imageBlob = await cy.png({output: "blob-promise", full: true});
                cy.on('tap', 'node', function () {
                    try { // your browser may block popups
                        window.open(this.data('link'));
                    } catch (e) { // fall back on url change
                        window.location.href = this.data('link');
                    }
                });
            })

        </script>
    @endpush
</x-app-layout>
