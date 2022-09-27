<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (session('warning'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="p-6 bg-white border-b border-gray-200 mwarning">
                        {!! __(session('warning')) !!}
                    </div>
                </div>
            </div>
    @endif



            @error('original_url')
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 mwarning">
                            <span class="text-red-400 m-2 p-2">{{ $message }}</span>
                        </div>
                    </div>
                </div>
                @enderror

                @if (session('success_message'))
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                                <div class="p-6 bg-white border-b border-gray-200 msuccess_message">
                                    {!! session('success_message') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif



                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200 m">

                                        <section>
                                            <h1 class="text-4xl text-blue-800">{{ __('Short your link') }}</h1>

                                            <form method="POST" action="{{ route('short.url' , app()->getLocale()) }}">
                                                @csrf
                                                <div class="grid grid-cols-1 md:grid-cols-2">
                                                    <div class="p-6">
                                                        <input class="border border-gray-300 rounded-lg fullwith"
                                                               type="text"
                                                               name="original_url"
                                                        />
                                                    </div>
                                                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                                                        <button class="button2 button-primary button-large"  type="submit">Short</button>
                                                    </div>
                                                </div>
                                                <div>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">{{ __('Id') }}</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">{{ __('Original Url') }}</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('Short Url') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('Visits') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('Actions') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr></tr>
                                            @foreach ($links as $link)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $link->id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap"><a href="{{ $link->original_url}}">{{ $link->original_url}}</a></td>
                                                    <td class="px-6 py-4 whitespace-nowrap"><a href="{{ url($link->short_url) }}">{{ url($link->short_url) }}</a></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $link->visits }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <a href="/{{app()->getLocale()}}/stats/{{ $link->id }}">{{ __('stats') }}</a> |
                                                        <a href="/{{app()->getLocale()}}/delete/{{ $link->id }}">{{ __('delete') }}</a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>



</x-app-layout>



