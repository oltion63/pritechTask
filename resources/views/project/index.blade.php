<x-app-layout>
    <div class="grid grid-cols-1 gap-6 mb-4 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 px-4 sm:px-6 lg:px-8 mt-20 justify-items-center w-full">
        @foreach($projects as $project)
            <div class="ride-card w-full max-w-sm rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition-all duration-200 hover:shadow-md relative flex flex-col justify-between min-h-48">

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full">
                            Project
                        </span>
                        <span class="text-xs text-red-600">{{$project->deadline}}</span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 line-clamp-2">
                        {{ $project->name }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                        {{ $project->description ?? 'No description provided.' }}
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-50 flex items-center justify-between">
                    <a href="{{route('projects.show', $project->id)}}" class="text-xs text-gray-400">View details</a>
                    <a href="{{route('projects.edit', $project->id)}}" class="inline-flex items-center justify-center p-2 rounded-lg bg-gray-50 text-gray-600 hover:bg-indigo-600 hover:text-white transition-colors duration-150">
                        Edit
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</x-app-layout>
