<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssueRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $issues = Issue::with('tags', 'comments')
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->priority, function ($query, $priority) {
                return $query->where('priority', $priority);
            })
            ->when($request->tag_id, function ($query, $tagId) {
                return $query->whereHas('tags', function ($q) {
                    $q->where('tags.id', request('tag_id'));
                });
            })
            ->get();

        $tags = Tag::all();

        return view('issues.index', compact('issues', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('issues.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIssueRequest $request)
    {
        $validated = $request->validated();
        Issue::create($validated);

        return redirect()->route('issues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $issue = Issue::with(['tags', 'comments', 'project'])->findOrFail($id);

        $allTags = Tag::all();
        return view('issues.show', compact('issue', 'allTags'));
    }

    public function attachTag(Request $request, Issue $issue)
    {
        $request->validate([
            'tag_id' => 'required|exists:tags,id'
        ]);

        $issue->tags()->syncWithoutDetaching($request->tag_id);

        return response()->json(['success' => true]);
    }

    public function detachTag(Issue $issue, Tag $tag)
    {
        $issue->tags()->detach($tag->id);

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $issue = Issue::findOrFail($id);
        $projects = Project::all();
        return view('issues.edit', compact('issue', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreIssueRequest $request, string $id)
    {
        $issue = Issue::where('id', $id)->first();
        $validated = $request->validated();

        $issue->update($validated);

        return redirect()->route('issues.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return redirect()->route('issues.index');
    }
}
