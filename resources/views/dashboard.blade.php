<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                @if(Auth::user()->role==\App\Enums\UserRole::SECURITY_OFFICER)
                    @if($assetsWithControlsToValidate->count()!=0)
                        <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Assets with Controls to Be Validated")}}</h2>
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
                                    {{__("Type")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Threats")}}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{__("Action")}}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assetsWithControlsToValidate as $asset)
                                <tr class="{{$asset->remainingRiskAccepted ? "bg-green-300" : "bg-white"}} border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{$asset->id}}</td>
                                    <td class="px-6 py-4">{{$asset->name}}</td>
                                    <td class="px-6 py-4">{{$asset->type->name}}</td>
                                    <td class="px-6 py-4">{{$asset->threats()->count()}}</td>
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

                    @endif
                @else
                    <ul class="list-decimal">
                        @foreach(Auth::user()->assets as $asset)
                            @if(!$asset->remainingRiskAccepted && $asset->active)
                                @if($asset->threats()->count()==0)
                                    <li>
                                        <a href="{{route("assets.edit",$asset->id)}}"
                                           target="_blank">{{__("The asset :name (:id) has no threats. Please add some.",["name"=>$asset->name,"id"=>$asset->id])}}</a>
                                    </li>
                                @else
                                    @foreach($asset->threats as $threat)
                                        @if($threat->controls()->count()==0)
                                            <li>
                                                <a href="{{route("assets.edit",$asset->id)}}"
                                                   target="_blank">{{__("The threat :threat_name associated with asset :name (:id) has no controls. Please add some.",["name"=>$asset->name,"id"=>$asset->id,"threat_name"=>$threat->threat->name])}}</a>
                                            </li>
                                        @else
                                            @if(!$threat->residual_risk_accepted)
                                                <li>
                                                    <a href="{{route("assets.edit",$asset->id)}}"
                                                       target="_blank">{{__("The remaining remaining risk associated with threat :threat_name associated with asset :name (:id) isn't accepted. Please accept it.",["name"=>$asset->name,"id"=>$asset->id,"threat_name"=>$threat->threat->name])}}</a>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    </ul>

                @endif
            </div>
        </div>
    </div>
</x-app-layout>
