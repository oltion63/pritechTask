<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Issue $issue)
    {
        // Fetch comments ordered by newest first, paginated by 5 items per block
        $comments = $issue->comments()
            ->latest()
            ->paginate(5);

        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Issue $issue)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'body' => 'required|string|min:3',
        ]);

        $comment = $issue->comments()->create($validated);

        return response()->json([
            'success' => true,
            'author_name' => $comment->author_name,
            'body' => $comment->body,
            'created_at' => $comment->created_at->diffForHumans(),
            'total_count' => $issue->comments()->count()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
