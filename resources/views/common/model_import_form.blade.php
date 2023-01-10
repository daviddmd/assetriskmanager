<form action="{{route("import-file")}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="model" value="{{$model}}">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
           for="{{$model."_file_input"}}">{{$message}}</label>
    <div class="flex">
        <input class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
               id="{{$model."_file_input"}}" type="file" name="file">
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__("Import")}}</button>
    </div>

</form>