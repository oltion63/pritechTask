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
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Assigned Members</h3>

                    <div id="assignee-error" class="hidden mb-3 text-xs bg-red-50 text-red-600 px-3 py-2 rounded-xl border border-red-100"></div>

                    <div id="issue-assignees-container" class="flex flex-wrap gap-2 items-center">
                        @forelse($issue->assignees as $user)
                            <span id="assignee-pill-{{ $user->id }}" class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg border border-slate-200 transition-all">
                                <div class="h-2 w-2 rounded-full bg-slate-400"></div>
                                {{ $user->name }}
                                <button type="button" class="hover:text-red-600 font-bold ml-1 text-sm text-slate-400 transition-colors" onclick="unassignUser({{ $user->id }})">×</button>
                            </span>
                        @empty
                            <p id="no-assignees-message" class="text-sm text-gray-400 italic">No team members assigned to this issue.</p>
                        @endforelse

                        <div class="ml-2">
                            <select id="assignee-selector" onchange="assignUser(this)" class="text-xs rounded-lg border-gray-300 bg-white py-1 pl-2 pr-8 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected disabled>+ Assign Member</option>
                                @foreach($allUsers as $user)
                                    <option id="assignee-option-{{ $user->id }}" value="{{ $user->id }}" class="{{ $issue->assignees->contains($user->id) ? 'hidden' : '' }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tags Section -->
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Tags</h3>

                    <div id="tag-error" class="hidden mb-3 text-xs bg-red-50 text-red-600 px-3 py-2 rounded-xl border border-red-100"></div>

                    <div id="issue-tags-container" class="flex flex-wrap gap-2 items-center">
                        @forelse($issue->tags as $tag)
                            <span id="tag-pill-{{ $tag->id }}" class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-lg border transition-all"
                                  style="background-color: {{ $tag->color }}15; color: {{ $tag->color }}; border-color: {{ $tag->color }}30;">
                                {{ $tag->name }}
                                <button type="button" class="hover:text-red-600 font-bold ml-1 text-sm" onclick="detachTag({{ $tag->id }})">×</button>
                            </span>
                        @empty
                            <p id="no-tags-message" class="text-sm text-gray-400 italic">No tags attached to this issue yet.</p>
                        @endforelse

                        <div class="ml-2">
                            <select id="tag-selector" onchange="attachTag(this)" class="text-xs rounded-lg border-gray-300 bg-white py-1 pl-2 pr-8 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected disabled>+ Add Tag</option>
                                @foreach($allTags as $tag)
                                    <option id="tag-option-{{ $tag->id }}" value="{{ $tag->id }}" data-color="{{ $tag->color }}" class="{{ $issue->tags->contains($tag->id) ? 'hidden' : '' }}">
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
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
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <input type="text" id="author_name" name="author_name" placeholder="Your Name" required
                                   class="w-full rounded-xl border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p id="error-author_name" class="text-xs text-red-600 mt-1 hidden"></p>
                        </div>
                    </div>
                    <div>
                        <textarea id="comment_body" name="body" rows="3" placeholder="Write a comment..." required
                                  class="w-full rounded-xl border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        <p id="error-body" class="text-xs text-red-600 mt-1 hidden"></p>
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

                <div class="mt-6 text-center">
                    <button id="load-more-btn" onclick="loadComments()" class="hidden px-4 py-2 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors">
                        Load Older Comments
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    const issueId = "{{ $issue->id }}";
    const csrfToken = document.querySelector('input[name="_token"]').value;
    let nextCommentPageUrl = `/issues/${issueId}/comments`;

    document.addEventListener("DOMContentLoaded", () => {
        loadComments();
    });


    function loadComments() {
        if (!nextCommentPageUrl) return;

        fetch(nextCommentPageUrl, {
            headers: { 'Accept': 'application/json' }
        })
            .then(res => res.json())
            .then(data => {
                const wrapper = document.getElementById('comments-wrapper');

                if (nextCommentPageUrl === `/issues/${issueId}/comments`) {
                    wrapper.innerHTML = '';
                }

                if (data.data.length === 0 && wrapper.children.length === 0) {
                    wrapper.innerHTML = `<p id="no-comments-message" class="text-sm text-center text-gray-400 py-4">No comments posted yet. Start the conversation!</p>`;
                    return;
                }

                data.data.forEach(comment => {
                    const dateStr = comment.created_at ? new Date(comment.created_at).toLocaleDateString() : 'Recent';
                    const html = renderCommentMarkup(comment.author_name, comment.body, dateStr);
                    wrapper.insertAdjacentHTML('beforeend', html);
                });

                nextCommentPageUrl = data.next_page_url;
                const loadMoreBtn = document.getElementById('load-more-btn');
                if (nextCommentPageUrl) {
                    loadMoreBtn.classList.remove('hidden');
                } else {
                    loadMoreBtn.classList.add('hidden');
                }
            });
    }


    function submitComment(event) {
        event.preventDefault();

        const form = event.target;
        const authorName = document.getElementById('author_name').value;
        const body = document.getElementById('comment_body').value;

        const authorError = document.getElementById('error-author_name');
        const bodyError = document.getElementById('error-body');
        authorError.classList.add('hidden');
        bodyError.classList.add('hidden');

        fetch(`/issues/${issueId}/comments`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ author_name: authorName, body: body })
        })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw data;

                const zeroMsg = document.getElementById('no-comments-message');
                if (zeroMsg) zeroMsg.remove();

                const commentHtml = renderCommentMarkup(data.author_name, data.body, 'Just now');
                document.getElementById('comments-wrapper').insertAdjacentHTML('afterbegin', commentHtml);

                document.getElementById('comment-count').innerText = data.total_count;
                form.reset();
            })
            .catch(err => {
                if (err.errors) {
                    if (err.errors.author_name) {
                        authorError.innerText = err.errors.author_name[0];
                        authorError.classList.remove('hidden');
                    }
                    if (err.errors.body) {
                        bodyError.innerText = err.errors.body[0];
                        bodyError.classList.remove('hidden');
                    }
                }
            });
    }

    function renderCommentMarkup(author, body, time) {
        return `
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 transition-all duration-200">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm font-bold text-gray-800">${escapeHTML(author)}</span>
                    <span class="text-xs text-gray-400">${time}</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">${escapeHTML(body)}</p>
            </div>`;
    }

    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g,
            tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
        );
    }

    function assignUser(selectElement) {
        const userId = selectElement.value;
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const userName = selectedOption.text;
        const errorDiv = document.getElementById('assignee-error');

        if (!userId) return;

        errorDiv.classList.add('hidden');

        fetch(`/issues/${issueId}/assign`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ user_id: userId })
        })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw data;

                const noAssigneesMsg = document.getElementById('no-assignees-message');
                if (noAssigneesMsg) noAssigneesMsg.remove();

                const assigneeHtml = `
            <span id="assignee-pill-${userId}" class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg border border-slate-200 transition-all">
                <div class="h-2 w-2 rounded-full bg-slate-400"></div>
                ${userName}
                <button type="button" class="hover:text-red-600 font-bold ml-1 text-sm text-slate-400 transition-colors" onclick="unassignUser(${userId})">×</button>
            </span>`;

                selectElement.parentNode.insertAdjacentHTML('beforebegin', assigneeHtml);
                document.getElementById(`assignee-option-${userId}`).classList.add('hidden');
                selectElement.value = "";
            })
            .catch(err => {
                errorDiv.innerText = err.message || 'Failed to assign user.';
                errorDiv.classList.remove('hidden');
                selectElement.value = "";
            });
    }

    function unassignUser(userId) {
        const errorDiv = document.getElementById('assignee-error');
        errorDiv.classList.add('hidden');

        fetch(`/issues/${issueId}/assign/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
            .then(async res => {
                if (!res.ok) {
                    const data = await res.json();
                    throw data;
                }

                document.getElementById(`assignee-pill-${userId}`).remove();

                const option = document.getElementById(`assignee-option-${userId}`);
                if (option) option.classList.remove('hidden');

                const assigneesContainer = document.getElementById('issue-assignees-container');
                if (assigneesContainer.querySelectorAll('span[id^="assignee-pill-"]').length === 0) {
                    assigneesContainer.insertAdjacentHTML('afterbegin', '<p id="no-assignees-message" class="text-sm text-gray-400 italic">No team members assigned to this issue.</p>');
                }
            })
            .catch(err => {
                errorDiv.innerText = err.message || 'Failed to remove user.';
                errorDiv.classList.remove('hidden');
            });
    }

    function attachTag(selectElement) {
        const tagId = selectElement.value;
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const tagName = selectedOption.text;
        const tagColor = selectedOption.getAttribute('data-color') || '#4f46e5';
        const errorDiv = document.getElementById('tag-error');

        if (!tagId) return;

        errorDiv.classList.add('hidden');

        fetch(`/issues/${issueId}/tags`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ tag_id: tagId })
        })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw data;

                const noTagsMsg = document.getElementById('no-tags-message');
                if (noTagsMsg) noTagsMsg.remove();

                const tagHtml = `
            <span id="tag-pill-${tagId}" class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-lg border transition-all"
                  style="background-color: ${tagColor}15; color: ${tagColor}; border-color: ${tagColor}30;">
                ${tagName}
                <button type="button" class="hover:text-red-600 font-bold ml-1 text-sm" onclick="detachTag(${tagId})">×</button>
            </span>`;

                selectElement.parentNode.insertAdjacentHTML('beforebegin', tagHtml);

                document.getElementById(`tag-option-${tagId}`).classList.add('hidden');
                selectElement.value = "";
            })
            .catch(err => {
                errorDiv.innerText = err.message || 'Failed to attach tag.';
                errorDiv.classList.remove('hidden');
                selectElement.value = "";
            });
    }

    function detachTag(tagId) {
        const errorDiv = document.getElementById('tag-error');
        errorDiv.classList.add('hidden');

        fetch(`/issues/${issueId}/tags/${tagId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
            .then(async res => {
                if (!res.ok) {
                    const data = await res.json();
                    throw data;
                }

                document.getElementById(`tag-pill-${tagId}`).remove();

                const option = document.getElementById(`tag-option-${tagId}`);
                if(option) option.classList.remove('hidden');

                const tagsContainer = document.getElementById('issue-tags-container');
                if (tagsContainer.querySelectorAll('span[id^="tag-pill-"]').length === 0) {
                    tagsContainer.insertAdjacentHTML('afterbegin', '<p id="no-tags-message" class="text-sm text-gray-400 italic">No tags attached to this issue yet.</p>');
                }
            })
            .catch(err => {
                errorDiv.innerText = err.message || 'Failed to remove tag.';
                errorDiv.classList.remove('hidden');
            });
    }
</script>
