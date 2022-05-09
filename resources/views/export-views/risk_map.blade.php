
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
