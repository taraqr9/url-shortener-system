<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('url.shortener') }}" method="POST">
                        @csrf
                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">URL
                                Shortener</label>
                            <div class="mt-2 flex">
                                <input type="text" name="original_url" placeholder="Enter your url here"
                                       class="block w-48 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        required>

                                <button
                                    type="submit"
                                    class="ml-4 block w-20 hover:bg-green-400 hover:text-white rounded-md border-2">
                                    Button
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="sm:col-span-3">
                        @auth
                            <section class="py-1 bg-blueGray-50">
                                <div class="w-full mb-12 xl:mb-0 px-4 mx-auto mt-24">
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
                        @else
                            <section class="py-1 bg-blueGray-50">
                                <div class="w-full mb-12 xl:mb-0 px-4 mx-auto mt-24">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                                        <div class="block w-full overflow-x-auto">
                                            <table class="items-center bg-transparent w-full border-collapse ">
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
                                                @if(isset($url))
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
                                                @else
                                                    <tr>
                                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                                            No url generated yet!
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
