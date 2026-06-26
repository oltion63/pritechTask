<x-app-layout>
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 mt-12">
        <div class="max-w-5xl mx-auto space-y-6">

            <div>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                    ← Back to All Projects
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-gray-100 pb-6 mb-6">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 bg-indigo-50 text-indigo-700 rounded-md">
                            Project #{{ $project->id }}
                        </span>
                    </div>

                    <div class="flex gap-6 text-sm text-gray-500">
                        <div>
                            <span class="font-medium text-gray-400">Started:</span>
                            <span class="font-semibold text-gray-700">{{ $project->start_date ?? 'Not set' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-400">Deadline:</span>
                            <span class="font-semibold text-gray-700">{{ $project->deadline ?? 'No deadline' }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        {{ $project->name }}
                    </h1>

                    <div class="bg-gray-50/70 rounded-xl p-5 border border-gray-100 mt-4">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Project Scope & Description</h4>
                        <p class="text-gray-700 text-base leading-relaxed whitespace-pre-line">
                            {{ $project->description ?? 'No description provided.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        Project Issues
                        <span class="text-xs bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full font-semibold">
                            {{ $project->issues->count() }}
                        </span>
                    </h3>

                    <a href="{{ route('issues.create', ['project_id' => $project->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white rounded-xl text-xs font-medium hover:bg-indigo-700 transition-colors">
                        + New Issue
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @forelse($project->issues as $issue)
                        <div class="border border-gray-100 bg-gray-50/50 rounded-xl p-4 flex flex-col justify-between hover:border-gray-200 transition-colors">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full uppercase
                                        {{ $issue->status === 'open' ? 'bg-red-50 text-red-700' : '' }}
                                        {{ $issue->status === 'in_progress' ? 'bg-amber-50 text-amber-700' : '' }}
                                        {{ $issue->status === 'closed' ? 'bg-gray-100 text-gray-700' : '' }}">
                                        {{ $issue->status }}
                                    </span>

                                    <span class="text-xs font-medium
                                        {{ $issue->priority === 'high' ? 'text-red-600' : '' }}
                                        {{ $issue->priority === 'medium' ? 'text-amber-600' : '' }}
                                        {{ $issue->priority === 'low' ? 'text-green-600' : '' }}">
                                        ● {{ ucfirst($issue->priority) }}
                                    </span>
                                </div>

                                <h4 class="text-sm font-bold text-gray-900 line-clamp-1 mb-1">
                                    {{ $issue->title }}
                                </h4>
                                <p class="text-xs text-gray-500 line-clamp-2">
                                    {{ $issue->description ?? 'No description provided.' }}
                                </p>
                            </div>

                            <div class="mt-4 pt-2 border-t border-gray-100 flex justify-end">
                                <a href="{{ route('issues.show', $issue->id) }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-200">
                            <p class="text-sm text-gray-400 italic">No issues tied to this project yet.</p>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
