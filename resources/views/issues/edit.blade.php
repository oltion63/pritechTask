<x-app-layout>
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 mt-12">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Edit Issue</h2>
            </div>
            <form id="delete-issue-form" action="{{ route('issues.delete', $issue->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            <form action="{{ route('issues.update', $issue->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                <div>
                    <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Issue</label>
                    <select
                        name="project_id"
                        id="project_id"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('project_id') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        required
                    >
                        <option value="" disabled {{ $issue->project->id ? '' : 'selected' }}>{{$issue->project->name}}</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Issue Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ $issue->title }}"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        placeholder="e.g., Fix login button crash"
                        required
                    >
                    @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        placeholder="Provide details about the issue..."
                        required
                    >{{ $issue->description }}</textarea>
                    @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select
                            name="status"
                            id="status"
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            required
                        >
                            <option value="open" {{ $issue->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ $issue->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="closed" {{$issue->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                        <select
                            name="priority"
                            id="priority"
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('priority') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            required
                        >
                            <option value="low" {{ $issue->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ $issue->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ $issue->priority == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input
                        type="date"
                        name="due_date"
                        id="due_date"
                        value="{{ $issue->due_date }}"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('due_date') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        required
                    >
                    @error('due_date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-4 pt-4 border-t border-gray-100">

                    <div>
                        <button
                            type="submit"
                            form="delete-issue-form"
                            class="px-5 py-2 rounded-xl bg-red-600 border border-transparent text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        >
                            Delete Issue
                        </button>
                    </div>

                    <div class="flex items-center gap-4">
                        <a
                            href="{{ route('issues.index') }}"
                            class="px-5 py-2 rounded-xl border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="px-5 py-2 rounded-xl bg-blue-600 border border-transparent text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Edit Issue
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>
