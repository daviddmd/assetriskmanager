<a href="/">
    @if(file_exists(public_path("storage/logo.png")))
        <img class="w-auto h-16" src="{{asset("storage/logo.png")}}" alt="Application Logo">
    @else
        <x-jet-application-logo class="w-16 h-16"></x-jet-application-logo>
    @endif
</a>
