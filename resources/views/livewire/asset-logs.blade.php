<div>
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
                    {{__("Date")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("User")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("Operation Type")}}
                </th>
                <th scope="col" class="px-3 py-3">
                    {{__("IP Address")}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($asset->logs as $log)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                    <td class="px-3 py-4">{{$log->id}}</td>
                    <td class="px-3 py-4">{{$log->created_at}}</td>
                    <td class="px-3 py-4">{{$log->user->email}} ({{$log->user->name}})</td>
                    <td class="px-3 py-4">{{__("enums.".$log->operation_type->name)}}</td>
                    <td class="px-3 py-4">{{$log->ip}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>
