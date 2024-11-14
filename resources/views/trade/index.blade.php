<x-app-layout>
    <div id="main-div" class="py-12">
        <form class="max-w-sm mx-auto">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your
                country</label>
            <select id="countries"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <option>United States</option>
                <option>Canada</option>
                <option>France</option>
                <option>Germany</option>
            </select>
        </form>


    </div>
</x-app-layout>

{{-- <div x-data="{ show: true, username: 'caleb' }">
    <button hx-get={{ route('trade.create') }} hx-target="#main-div">Add post</button>
    Username: <strong x-text="username"></strong>
    <p x-show="show">I am hidden if false</p>
</div> --}}
