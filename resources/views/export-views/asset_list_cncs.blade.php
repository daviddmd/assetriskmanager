<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
    <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        <th scope="col" class="px-6 py-3">
            <b>Serviço Suportado</b>
        </th>
        <th scope="col" class="px-6 py-3">
            <b>Nome do equipamento/Nome do software</b>
        </th>
        <th scope="col" class="px-6 py-3">
            <b>Modelo/Versão</b>
        </th>
        <th scope="col" class="px-6 py-3">
            <b>Endereço IP (se aplicável)</b>
        </th>
        <th scope="col" class="px-6 py-3">
            <b>FQDN (se aplicável)</b>
        </th>
        <th scope="col" class="px-6 py-3">
            <b>Fabricante</b>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($assets as $asset)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
            <td class="px-6 py-4">{{$asset->description}}</td>
            <td class="px-6 py-4">{{$asset->name}}</td>
            <td class="px-6 py-4">{{$asset->version}}</td>
            <td class="px-6 py-4">{{$asset->ip_address}}</td>
            <td class="px-6 py-4">{{$asset->fqdn}}</td>
            <td class="px-6 py-4">{{$asset->manufacturer}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
