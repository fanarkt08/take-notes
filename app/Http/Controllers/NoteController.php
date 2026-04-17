<?php

namespace App\Http\Controllers;

use App\Mail\NoteCreated;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasPermissionTo('manage notes')) {
            $notes = Note::with('user')->get();
        } else {
            $notes = Note::where('user_id', $user->id)->get();
        }

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        Gate::authorize('create', Note::class);

        return view('notes.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Note::class);

        $validated = $request->validate([
            'title'   => 'required|min:3|max:255',
            'content' => 'required|min:5',
        ]);

        $note = new Note($validated);
        $note->user()->associate(Auth::user());
        $note->save();

        Mail::to(Auth::user()->email)->send(new NoteCreated($note));

        return redirect()
            ->route('notes.index')
            ->with('status', 'Note créée avec succès.');
    }

    public function show(Note $note)
    {
        Gate::authorize('view', $note);

        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        Gate::authorize('update', $note);

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'title'   => 'required|min:3|max:255',
            'content' => 'required|min:5',
        ]);

        $note->update($validated);

        return redirect()
            ->route('notes.index')
            ->with('status', 'Note mise à jour avec succès.');
    }

    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return redirect()
            ->route('notes.index')
            ->with('status', 'Note supprimée avec succès.');
    }
}
