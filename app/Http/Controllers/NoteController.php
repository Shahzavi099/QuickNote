<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::latest('updated_at');
        if (request('search')){
            $notes
            ->where('title','like','%'.request('search').'%')
            ->orWhere('content','like','%'.request('search').'%');
        }
        return response()->json($notes->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string'
        ]);
        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content
        ]);
        return response()->json([
            'message' => 'Note created successfully',
            'data' => $note
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::findOrFail($id);
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string'
        ]);
        $note->fill($request->only(['title', 'content']));
        $note->save();
        return response()->json([
            'message' => 'Note updated successfully',
            'data' => $note
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json([
            'message' => 'Note deleted successfully',
            'data' => $note
        ]);
    }
}
