<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PublisherRequest;
use App\Http\Resources\PublisherCollection;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

/** @see \Tests\Feature\PublisherControllerTest */
class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): InertiaResponse
    {
        $resource = new PublisherCollection(Publisher::all());

        return Inertia::render('publisher/index', [
            'publishers' => $resource,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('publisher/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublisherRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Publisher::create($validated);

        return response()->json([
            'message' => 'Created',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher): InertiaResponse
    {
        return Inertia::render('publisher/show', [
            'publisher' => new PublisherResource($publisher),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher): InertiaResponse
    {
        return Inertia::render('publisher/edit', [
            'publisher' => new PublisherResource($publisher),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherRequest $request, Publisher $publisher): JsonResponse
    {
        $validated = $request->validated();
        $publisher->update($validated);

        return response()->json($publisher, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher): Response
    {
        $publisher->delete();

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
