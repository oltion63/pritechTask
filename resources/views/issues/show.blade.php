<x-app-layout>
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 mt-12">
        <div class="max-w-4xl mx-auto space-y-6">

            <div>
                <a href="{{ route('issues.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                    ← Back to All Issues
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-gray-100 pb-6 mb-6">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            {{ $issue->project->name ?? 'Unassigned Project' }}
                        </span>

                        <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 bg-indigo-50 text-indigo-700 rounded-md">
                            Issue #{{ $issue->id }}
                        </span>

                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full uppercase
                            {{ $issue->status === 'open' ? 'bg-red-50 text-red-700' : '' }}
                            {{ $issue->status === 'in_progress' ? 'bg-amber-50 text-amber-700' : '' }}
                            {{ $issue->status === 'closed' ? 'bg-gray-100 text-gray-700' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                        </span>

                        <span class="text-xs font-medium px-2.5 py-1 rounded-full
                            {{ $issue->priority === 'high' ? 'bg-rose-50 text-rose-700 font-semibold' : '' }}
                            {{ $issue->priority === 'medium' ? 'bg-orange-50 text-orange-700' : '' }}
                            {{ $issue->priority === 'low' ? 'bg-emerald-50 text-emerald-700' : '' }}">
                            ● {{ ucfirst($issue->priority) }} Priority
                        </span>
                    </div>

                    <div class="text-sm text-gray-500 flex items-center gap-1">
                        <span class="font-medium text-gray-400">Due:</span>
                        <span class="font-semibold text-gray-700">{{ $issue->due_date ?? 'No deadline' }}</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        {{ $issue->title }}
                    </h1>

                    <div class="bg-gray-50/70 rounded-xl p-5 border border-gray-100 mt-4">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Description</h4>
                        <p class="text-gray-700 text-base leading-relaxed whitespace-pre-line">
                            {{ $issue->description }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Tags</h3>

                    <div id="issue-tags-container" class="flex flex-wrap gap-2 items-center">
                        @forelse($issue->tags as $tag)
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded-lg border border-gray-200">
                                {{ $tag->name }}
                                <button type="button" class="text-gray-400 hover:text-red-500 font-bold ml-1" onclick="detachTag({{ $tag->id }})">×</button>
                            </span>
                        @empty
                            <p class="text-sm text-gray-400 italic id='no-tags-message'">No tags attached to this issue yet.</p>
                        @endforelse

                        <div class="ml-2">
                            <select id="tag-selector" onchange="attachTag(this.value)" class="text-xs rounded-lg border-gray-300 bg-white py-1 pl-2 pr-8 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected disabled>+ Add Tag</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                    Comments
                    <span id="comment-count" class="text-xs bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full font-semibold">
                        {{ $issue->comments->count() }}
                    </span>
                </h3>

                <form id="ajax-comment-form" onsubmit="submitComment(event)" class="mb-8 space-y-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <input type="text" id="author_name" name="author_name" placeholder="Your Name" required
                                   class="w-full rounded-xl border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div>
                        <textarea id="comment_body" name="body" rows="3" placeholder="Write a comment..." required
                                  class="w-full rounded-xl border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors shadow-xs">
                            Post Comment
                        </button>
                    </div>
                </form>

                <div id="comments-wrapper" class="space-y-4">
                    <p class="text-sm text-center text-gray-400 py-4">Loading comments...</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
