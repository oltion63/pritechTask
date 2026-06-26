<x-app-layout>
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 mt-12">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Create New Tag</h2>
            </div>

            <form action="{{ route('tags.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        placeholder="e.g., Bug, Feature, Documentation"
                        required
                    >
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Tag Color</label>
                    <div class="flex items-center gap-3">
                        <input
                            type="color"
                            name="color"
                            id="color"
                            value="{{ old('color', '#4f46e5') }}"
                            class="h-10 w-16 p-1 bg-white border border-gray-300 rounded-xl cursor-pointer shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                        <span class="text-xs text-gray-500">Pick a distinct reference color accent for this tag label.</span>
                    </div>
                    @error('color')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                    <a
                        href="{{ route('tags.index') }}"
                        class="px-5 py-2 rounded-xl border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-blue-600 border border-transparent text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Create Tag
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
