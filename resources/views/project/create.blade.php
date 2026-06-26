<x-app-layout>
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 mt-12">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Create New Project</h2>
            </div>


            <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-xl border-gray-300 shadow-sm "
                        placeholder="e.g., Website Redesign"
                        required
                    >
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full rounded-xl border-gray-300 shadow-sm "
                        placeholder="Describe the scope and goals of this project..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input
                            type="date"
                            name="start_date"
                            id="start_date"
                            value="{{ old('start_date') }}"
                            class="w-full rounded-xl border-gray-300 shadow-sm"
                        >
                        @error('start_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                        <input
                            type="date"
                            name="deadline"
                            id="deadline"
                            value="{{ old('deadline') }}"
                            class="w-full rounded-xl border-gray-300 shadow-sm "
                        >
                        @error('deadline')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                    <a
                        href="{{ route('projects.index') }}"
                        class="px-5 py-2 rounded-xl border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-blue-600 border border-transparent text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2"
                    >
                        Create Project
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
