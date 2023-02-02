<footer class="p-4 bg-white rounded-lg shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800">
    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
        <span class="inline-block rotate-180">&copy;</span>
        {{date("Y")}}
        <a target="_blank" href="https://github.com/daviddmd/assetriskmanager" class="hover:underline">Asset Risk Manager</a>
    </span>
    <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
        <li>
            <a target="_blank" href="https://www.gnu.org/licenses/agpl-3.0.txt"
               class="mr-4 hover:underline md:mr-6">{{__("License")}}</a>
        </li>
        <li>
            <a class="mr-4 hover:underline md:mr-6 ">{{__("Version")}} {{config("app.version")}}</a>
        </li>
    </ul>
</footer>