<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 w-full">

        <form action="{{ route('issues.index') }}" method="GET" class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-wrap gap-4 items-end">

            <div class="w-full sm:w-auto min-w-[150px]">
                <label for="status" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status</label>
                <select name="status" id="status" onchange="this.form.submit()" class="w-full rounded-xl border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All Statuses</option>
                    <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="w-full sm:w-auto min-w-[150px]">
                <label for="priority" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Priority</label>
                <select name="priority" id="priority" onchange="this.form.submit()" class="w-full rounded-xl border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All Priorities</option>
                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="w-full sm:w-auto min-w-[150px]">
                <label for="tag_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tag</label>
                <select name="tag_id" id="tag_id" onchange="this.form.submit()" class="w-full rounded-xl border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All Tags</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(request()->filled('status') || request()->filled('priority') || request()->filled('tag_id'))
                <a href="{{ route('issues.index') }}" class="text-xs text-red-500 font-medium hover:text-red-700 pb-3 transition-colors">
                    Clear Filters ×
                </a>
            @endif
        </form>

        <div class="grid grid-cols-1 gap-6 mb-4 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 justify-items-center w-full">
            @forelse($issues as $issue)
                <div class="ride-card w-full max-w-sm rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition-all duration-200 hover:shadow-md hover:border-gray-200 relative flex flex-col justify-between min-h-48">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md">Issue</span>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $issue->status === 'closed' ? 'bg-gray-100 text-gray-600' : '' }} {{ $issue->status === 'in_progress' ? 'bg-amber-50 text-amber-700' : '' }} {{ $issue->status === 'open' ? 'bg-red-50 text-red-600' : '' }}">{{ ucfirst($issue->status) }}</span>
                        </div>

                        <div class="flex items-center gap-1 mb-2 text-xs font-medium text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            <span class="truncate hover:text-indigo-600 transition-colors">
                                {{ $issue->project->name ?? 'Unassigned Project' }}
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 line-clamp-2 tracking-tight">{{ $issue->title }}</h3>

                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="text-xs font-medium {{ $issue->priority === 'high' ? 'text-red-600' : '' }} {{ $issue->priority === 'medium' ? 'text-amber-600' : '' }} {{ $issue->priority === 'low' ? 'text-green-600' : '' }}">● {{ ucfirst($issue->priority) }} Priority</span>
                        </div>

                        <p class="text-sm text-gray-500 mt-2 line-clamp-2 leading-relaxed">{{ $issue->description ?? 'No description provided.' }}</p>
                    </div>

                    <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between">
                        <a href="{{route('issues.show', $issue->id)}}" class="text-xs font-medium text-gray-500 hover:text-indigo-600 transition-colors duration-150">View details →</a>
                        <a href="{{route('issues.edit', $issue->id)}}" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium rounded-xl bg-gray-50 text-gray-600 hover:bg-indigo-600 hover:text-white shadow-xs transition-colors duration-150">Edit</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-400">
                    No issues found matching those filters.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
