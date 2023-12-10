<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit URL') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ml-4">
                    <form action="{{ route('url.update', ['url' => $url]) }}" method="POST">
                        @csrf
                        <div class="sm:col-span-3 items-center">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Original Url</label>
                            <div class="mt-2">
                                <input type="text" value="{{ $url->original_url }}" name="original_url" placeholder="Enter your url here"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       required>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="mt-4 w-20 hover:bg-green-400 hover:text-white rounded-md border-2">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
