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
            {{__("Remaining Risk After Controls")}}
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
        </tr>
    @endforeach
    </tbody>
</table>
