<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    private $note_service;

    /**
     * make controller instance
     *
     * @return void
     */
    public function __construct(NoteService $note_service)
    {
        $this->note_service = $note_service;
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


    /**
     * 一般公開済みのNoteを出力
     * 非認証のメソッド
     *
     * @param Request $request
     * @return NoteResource
     */
    public function showPublished(Request $request)
    {
        $note = $this->note_service->findPublished($request->published_id);
        if (!isset($note)) abort(404);
        return new NoteResource($note);
    }


    /**
     * 公開にする
     *
     * @param Request $request
     * @return never|string
     * @throws AuthorizationException
     */
    public function publish(Request $request)
    {
        $note = $this->note_service->find($request->id);
        $this->authorize('publish', $note);
        return $this->note_service->publish($note) ?? abort(404);
    }


    /**
     * 非公開にする
     *
     * @param Request $request
     * @return Response|never
     * @throws AuthorizationException
     */
    public function unpublish(Request $request)
    {
        $note = $this->note_service->find($request->id);
        $this->authorize('unpublish', $note);
        return $this->note_service->unpublish($note) ? response()->noContent() : abort(404);
    }
}
