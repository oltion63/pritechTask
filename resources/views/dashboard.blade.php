<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center space-x-4 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{route('projects.index')}}">
                    <div class="p-6 text-gray-900 ">
                        Go to projects
                    </div>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{route('issues.index')}}">
                    <div class="p-6 text-gray-900">
                        Go to issues
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
