<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * make controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Note::class, 'note');
    }


    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return NoteResource::collection(Auth::user()->notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NoteRequest $request
     * @return Response
     */
    public function store(NoteRequest $request)
    {
        return response(new NoteResource(Auth::user()->notes()->create($request->all())), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Note $note
     * @return NoteResource
     */
    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NoteRequest $request
     * @param Note $note
     * @return Response
     */
    public function update(NoteRequest $request, Note $note)
    {
        $note->fill($request->all())->save();
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Note $note
     * @return Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return response()->noContent();
    }
}
