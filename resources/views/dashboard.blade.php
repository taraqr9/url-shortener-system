<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('url.shortener') }}" method="POST">
                        @csrf
                        <div class="sm:col-span-3 ml-4">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">URL
                                Shortener</label>
                            <div class="mt-2 flex">
                                <input type="text" name="original_url" placeholder="Enter your url here"
                                       class="block w-48 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       required>

                                <button
                                    type="submit"
                                    class="ml-4 block w-20 hover:bg-green-400 hover:text-white rounded-md border-2">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="sm:col-span-3">
                        @auth
                            @if(!empty($urls) && !$urls->isEmpty())
                                <section class="py-1 bg-blueGray-50 w-full">
                                    <div class="w-full mb-12 xl:mb-0 px-4 mt-12">
                                        <div
                                            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                                            <div class="block w-full overflow-x-auto">
                                                <table class="items-center bg-transparent w-full border-collapse ">
                                                    <thead>
                                                    <tr>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            #
                                                        </th>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            Original Link
                                                        </th>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            Short Link
                                                        </th>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            Total Visit
                                                        </th>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            Create At
                                                        </th>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            Actions
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    @foreach($urls as $url)
                                                        <tr>
                                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                                {{ $url->original_url }}
                                                            </td>
                                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                                                <a href="{{ route('shortener.redirect', ['shortUrl' => $url->short_url]) }}">
                                                                    {{ config('app.url'). '/url/' . $url->short_url }}
                                                                </a>
                                                            </td>
                                                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                                {{ $url->click_count }}
                                                            </td>
                                                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                                {{ $url->created_at->format('F j, Y, g:i a') }}
                                                            </td>
                                                            <td class=" flex border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                                <a href="{{ route('url.edit', ['url' => $url]) }}"
                                                                   data-id="{{ $url->id }}" id="edit_url">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                         viewBox="0 0 24 24" stroke-width="1.5"
                                                                         stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                                    </svg>
                                                                </a>

                                                                <a href="{{ route('url.delete', ['url' => $url]) }}"
                                                                   onclick="return confirm('Are you sure?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                         viewBox="0 0 24 24" stroke-width="1.5"
                                                                         stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            {{ $urls->links() }}
                                        </div>
                                    </div>
                                </section>
                            @endif
                        @endauth
                        @guest
                            <section class="py-1 bg-blueGray-50">
                                <div class="w-full mb-12 xl:mb-0 px-4 mx-auto mt-24">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                                        <div class="block w-full overflow-x-auto">
                                            @if(isset($url))
                                                <table
                                                    class="items-center bg-transparent w-full border-collapse ">
                                                    <thead>
                                                    <tr>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            Original Link
                                                        </th>
                                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                            Short Link
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    <tr>
                                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                                            {{ $url->original_url }}
                                                        </td>
                                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                                            <a href="{{ route('shortener.redirect', ['shortUrl' => $url->short_url]) }}">
                                                                {{ config('app.url'). '/url/' . $url->short_url }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
