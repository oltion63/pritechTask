<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 w-full">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Create Tags</h2>
            </div>
            <a href="{{ route('tags.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors shadow-xs">
                Create Tag
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 text-sm bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-100">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="divide-y divide-gray-100">

                <div class="bg-gray-50/70 px-6 py-3 flex items-center justify-between text-xs font-bold uppercase tracking-wider text-gray-400">
                    <div class="w-1/2">Tag Name</div>
                    <div class="w-1/4 text-center">Color (Hex)</div>
                    <div class="w-1/4 text-right">Actions</div>
                </div>

                @forelse($tags as $tag)
                    <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors">

                        <div class="w-1/2 flex items-center gap-3">
                            <span class="h-3 w-3 rounded-full shrink-0 shadow-xs" style="background-color: {{ $tag->color }};"></span>

                            <span class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-lg border text-gray-800"
                                  style="background-color: {{ $tag->color }}15; border-color: {{ $tag->color }}30;">
                                {{ $tag->name }}
                            </span>
                        </div>

                        <div class="w-1/4 text-center font-mono text-xs text-gray-500 tracking-tight">
                            {{ $tag->color }}
                        </div>

                        <div class="w-1/4 flex items-center justify-end">
                            <form action="{{ route('tags.delete', $tag->id) }}" method="POST" onsubmit="return ">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100/70 px-3 py-1.5 rounded-xl transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="p-12 text-center text-gray-400 italic text-sm">
                        No tags found in system. Click "Create Tag" to add your first tag.
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</x-app-layout>
