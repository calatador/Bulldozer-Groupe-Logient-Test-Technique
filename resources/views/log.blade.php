<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Access log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('Access time') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('url') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('user') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('ip') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('country') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    {{ __('user_agent') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr></tr>
                                            @foreach ($logs as $log)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->access_time }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->url}}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($log->user)
                                                            {{ $log->user->name}}
                                                        @else
                                                            {{ __('visitor') }}
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">{{$log->ip}}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->country }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->user_agent }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                    <div class="m-2 p-2">
                        {{ $logs->links() }}
                    </div>


                </div>
            </div>
        </div>

    </div>



</x-app-layout>



